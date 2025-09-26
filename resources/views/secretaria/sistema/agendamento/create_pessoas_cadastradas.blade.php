@extends('secretaria.layout_secretaria.pagina_inicialSecretaria')

@section('formulario_secretaria')
    <div class="container">
        <h2>Novo Agendamento para {{ $pessoa->nome }}</h2>

        <form action="{{ route('agendamentos.store_pessoas_cadastradas') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pessoa_id" value="{{ $pessoa->id }}">

            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="dataInput" name="dataInput" required>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora" name="horaInput" required>
            </div>

            <div class="mb-3">
                <label for="observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="observacoes" name="observacaoInput" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="arquivoInput" class="form-label">Arquivo:</label>
                <input type="file" name="arquivoInput" class="form-control" id="arquivoInput">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
        </form>
    </div>
@endsection
