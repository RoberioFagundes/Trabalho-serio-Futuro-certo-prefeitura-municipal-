@extends('secretaria.layout_secretaria.pagina_inicialSecretaria')

@section('formulario_secretaria')
<form method="post" action="{{ route('remarcacao-story') }}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row g-3">
           

            <!-- Card da Coluna 1 -->
            <div class="col-12 col-md-12">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Dados do Re-Agendamento</h5>
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <input type="hidden" name="agendamento_id" value="{{$agendamento->id}}">
                        <div class="mb-3">
                            <label for="nomeInput" class="form-label">Nome:</label>
                            <input type="text" name="nomeInput" value="{{$agendamento->pessoa->nome}}" class="form-control" id="nomeInput">
                        </div>

                        <div class="mb-3">
                            <label for="observacaoInput" class="form-label">Observação:</label>
                            <textarea class="form-control" name="MotivoInput" id="observacaoInput" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="dataInput" class="form-label">Data:</label>
                            <input type="date" name="dataNova" class="form-control" id="dataInput">
                        </div>

                        <div class="mb-3">
                            <label for="horaInput" class="form-label">Hora:</label>
                            <input type="time" name="horaNova" class="form-control" id="horaInput">
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
