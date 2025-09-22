use App\Models\Agendamento;
use App\Models\AgendamentoHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemarcacaoAgendamentoMail;
use App\Notifications\AgendamentoRemarcado;

public function remarcar(Request $request, $id)
{
    $request->validate([
        'nova_data' => 'required|date',
        'nova_hora' => 'required',
        'motivo_remarcacao' => 'nullable|string|max:255',
    ]);

    $agendamento = Agendamento::findOrFail($id);

    // Conflito de horário
    if (Agendamento::where('data', $request->nova_data)
        ->where('hora', $request->nova_hora)
        ->where('id', '!=', $agendamento->id)
        ->exists()
    ) {
        return redirect()->back()->with('error', 'Já existe um agendamento nesse horário.');
    }

    DB::transaction(function () use ($agendamento, $request) {
        // Histórico
        AgendamentoHistory::create([
            'agendamento_id' => $agendamento->id,
            'user_id' => auth()->id(),
            'nova_data' => $request->nova_data,
            'nova_hora' => $request->nova_hora,
            'motivo' => $request->motivo_remarcacao,
        ]);

        // Atualiza agendamento
        $agendamento->data = $request->nova_data;
        $agendamento->hora = $request->nova_hora;
        $agendamento->status = 'remarcado';
        $agendamento->motivo_remarcacao = $request->motivo_remarcacao;
        $agendamento->save();

        // Atualiza fila
        if ($agendamento->fila) {
            $ultimoNumero = $agendamento->fila->max('numero') ?? 0;
            $agendamento->fila->numero = $ultimoNumero + 1;
            $agendamento->fila->save();
        }

        // Notificação e e-mail
        $agendamento->user->notify(new AgendamentoRemarcado($agendamento));
        Mail::to($agendamento->user->email)
            ->queue(new RemarcacaoAgendamentoMail($agendamento));
    });

    \Log::info("Agendamento #{$agendamento->id} remarcado por usuário #" . auth()->id());

    return redirect()->route('agendamentos.index')
                     ->with('success', 'Agendamento remarcado com sucesso!');
}




php artisan make:notification AgendamentoRemarcado


namespace App\Notifications;

use App\Models\Agendamento;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AgendamentoRemarcado extends Notification
{
    use Queueable;

    public $agendamento;

    public function __construct(Agendamento $agendamento)
    {
        $this->agendamento = $agendamento;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast']; // envia para DB e broadcast
    }

    public function toDatabase($notifiable)
    {
        return [
            'agendamento_id' => $this->agendamento->id,
            'data' => $this->agendamento->data,
            'hora' => $this->agendamento->hora,
            'mensagem' => 'Seu agendamento foi remarcado!'
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'agendamento_id' => $this->agendamento->id,
            'data' => $this->agendamento->data,
            'hora' => $this->agendamento->hora,
            'mensagem' => 'Seu agendamento foi remarcado!'
        ]);
    }
}
