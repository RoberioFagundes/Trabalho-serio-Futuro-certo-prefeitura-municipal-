@extends('secretaria.layout_secretaria.pagina_inicialSecretaria')

@section('formulario_secretaria')
    <form method="post" action="{{ route('filas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="container mt-4">
            <div class="row">

                <!-- Card da Coluna 1 -->
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card shadow-sm rounded-3">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Dados para Fila</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">

                                <input type="hidden" name="agendamento_id" value="{{$agendamentoCidadao->id}}">
                                <!-- Nome -->
                                <div class="col-12 col-md-12">
                                    <label for="nome" class="form-label fw-bold">Nome:</label>
                                    <input type="text" name="nomeCidadaoFila" class="form-control"
                                        value="{{ $agendamentoCidadao->pessoa->nome }}" id="nome"
                                        placeholder="Digite o nome" required>
                                </div>

                                <!-- Número de Protocolo -->
                                <div class="col-12 col-md-12">
                                    <label for="numeroProcolo" class="form-label fw-bold">Posição na fila:</label>
                                    <input type="text" name="numeroProcolo" value="{{ $agendamentoCidadao->id }}ª posição da fila"
                                        class="form-control" id="numeroProcolo" placeholder="Digite o número de protocolo"
                                        required>
                                </div>

                                 {{-- <!-- Número de Protocolo -->
                                <div class="col-12 col-md-12">
                                    <label for="numeroProcolo" class="form-label fw-bold">Horário de Comparecimneto:</label>
                                    <input type="time" name="hora_comparecimento" value=""
                                        class="form-control" id="numeroProcolo" placeholder="Digite o número de protocolo"
                                        required>
                                </div> --}}

                              

                                {{-- <div class="orm-label fw-bold">
                                    <label for="observacoes"  class="form-label fw-bold">Atendimento Preferencial
                                    </label><br>
                                    <select class="col-12 col-md-6" name="preferencia">
                                        <option class="form-control" value="">Selecione</option>
                                        <option class="form-control" value="sim">Sim</option>
                                        <option class="form-control" value="nao">Não</option>
                                    </select>
                                </div>

                                <div class="orm-label fw-bold">
                                    <label for="observacoes" class="form-label fw-bold">Motivo do atendimnento Preferencial
                                    </label><br>
                                    <textarea name="motivo_atendimento_preferencial" class="col-12 col-md-6">
                                
                                </textarea>
                                </div> --}}


                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success">Salvar Fila</button>
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
