@extends('secretaria.layout_secretaria.pagina_inicialSecretaria')

@section('formulario_secretaria')
<form method="post" action="{{ route('remarcacao.update', $agendamento_history->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="row g-3">
           

            <!-- Card da Coluna 1 -->
            <div class="col-12 col-md-12">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Atualizar Remarcação</h5>
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <input type="hidden" name="agendamento_id" value="{{$agendamento_history->id}}">
                        <div class="mb-3">
                            <label for="nomeInput" class="form-label">Data Nova:</label>
                            <input type="date" name="nova_data" value="{{ old('nova_data', $agendamento_history->nova_data) }}" class="form-control" id="nomeInput">
                        </div>

                         <div class="mb-3">
                            <label for="nomeInput" class="form-label">Hora Nova:</label>
                            <input type="time" name="nova_hora" value="{{$agendamento_history->nova_hora}}" class="form-control" id="nomeInput">
                        </div>


                         <div>
                            <label for="motivo_remarcacao">Motivo:</label><br>
                           <textarea name="motivo" id="motivo">{{ old('motivo', $agendamento_history->motivo) }}</textarea>

                        </div>

                          <div class="mb-3">
                           <button type="submit" class="btn btn-primary btn-lg mt-3">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</form>
@endsection
