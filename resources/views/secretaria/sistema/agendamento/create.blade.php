@extends('secretaria.layout_secretaria.pagina_inicialSecretaria')

@section('formulario_secretaria')
<form method="post" action="{{ route('agendamentos.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="row g-3">
            {{-- Exibe todos os erros em uma lista no topo --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

            <!-- Card da Coluna 1 -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Dados do Agendamento</h5>
                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="mb-3">
                            <label for="nomeInput" class="form-label">Nome:</label>
                            <input type="text" name="nomeInput" class="form-control" id="nomeInput">
                            @error('nomeInput')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="observacaoInput" class="form-label">Observação:</label>
                            <textarea class="form-control" name="observacaoInput" id="observacaoInput" rows="5"></textarea>
                            @error('observacaoInput')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                        <label for="dataInput" class="form-label">Data:</label>
                        <input type="date"
                            name="dataInput"
                            id="dataInput"
                            value="{{ old('dataInput') }}"
                            class="form-control @error('dataInput') is-invalid @enderror">

    {{-- Aqui será exibido o erro, seja final de semana ou feriado --}}
  
</div>


                        <div class="mb-3">
                            <label for="horaInput" class="form-label">Hora:</label>
                            <input type="time" name="horaInput" class="form-control" id="horaInput">
                            @error('Hora')
                                 <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cpfInput" class="form-label">CPF:</label>
                            <input type="number" name="cpfInput" class="form-control" id="cpfInput">
                            @error('cpfInput')
                                {{ $message}}
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="telefoneInput" class="form-label">Telefone:</label>
                            <input type="number" name="telefoneInput" class="form-control" id="telefoneInput">
                            @error('telefone')
                                {{$message}}
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="arquivoInput" class="form-label">Arquivo:</label>
                            <input type="file" name="arquivoInput" class="form-control" id="arquivoInput">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card da Coluna 2 -->
            <div class="col-12 col-md-6">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Endereço do Cidadão</h5>

                        <div class="mb-3">
                            <label for="estadoInput" class="form-label">Estado</label>
                            <input type="text" id="estadoInput" name="estadoInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="cidadeInput" class="form-label">Cidade</label>
                            <input type="text" id="cidadeInput" name="cidadeInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="bairroInput" class="form-label">Bairro</label>
                            <input type="text" id="bairroInput" name="bairroInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="ruaInput" class="form-label">Rua</label>
                            <input type="text" name="ruaInput" id="ruaInput" class="form-control">
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
