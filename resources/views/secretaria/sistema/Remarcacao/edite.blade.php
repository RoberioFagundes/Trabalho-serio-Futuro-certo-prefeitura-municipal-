@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Remarcar Agendamento</h1>

    <!-- Mensagens -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('agendamentos.remarcar', $agendamento->id) }}" method="POST" class="bg-white p-4 rounded shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Usuário:</label>
            <input type="text" value="{{ $agendamento->user->name }}" disabled class="border px-2 py-1 rounded w-full bg-gray-100">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Número na fila:</label>
            <input type="text" value="{{ $agendamento->fila?->numero ?? '-' }}" disabled class="border px-2 py-1 rounded w-full bg-gray-100">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Nova Data:</label>
            <input type="date" name="nova_data" value="{{ old('nova_data', $agendamento->data) }}" required class="border px-2 py-1 rounded w-full">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Nova Hora:</label>
            <input type="time" name="nova_hora" value="{{ old('nova_hora', $agendamento->hora) }}" required class="border px-2 py-1 rounded w-full">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Motivo (opcional):</label>
            <textarea name="motivo_remarcacao" class="border px-2 py-1 rounded w-full">{{ old('motivo_remarcacao', $agendamento->motivo_remarcacao) }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Salvar Remarcação</button>
            <a href="{{ route('agendamentos.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Cancelar</a>
        </div>
    </form>

    <!-- Histórico -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-2">Histórico de Remarcações</h2>
        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">Data/Hora</th>
                    <th class="border px-2 py-1">Motivo</th>
                    <th class="border px-2 py-1">Responsável</th>
                    <th class="border px-2 py-1">Registrado em</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agendamento->historicos as $hist)
                <tr>
                    <td class="border px-2 py-1">{{ $hist->nova_data }} {{ $hist->nova_hora }}</td>
                    <td class="border px-2 py-1">{{ $hist->motivo ?? '-' }}</td>
                    <td class="border px-2 py-1">{{ $hist->user->name }}</td>
                    <td class="border px-2 py-1">{{ $hist->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Notificação em tempo real -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    Echo.private('App.Models.User.{{ $agendamento->user->id }}')
        .notification((notification) => {
            alert('Notificação: ' + notification.mensagem);
        });
</script>
@endsection
