<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@include('titulo')</title>
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('template/assets/images/logos/favicon.png') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!--  App Topstrip -->
        <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
                <a class="d-flex justify-content-center" href="#">

                </a>


            </div>

            <div class="d-lg-flex align-items-center gap-2">
                <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">Prefeitura Municipal - Palmas de Monte Alto - Bahia
                </h3>
                <div class="d-flex align-items-center justify-content-center gap-2">

                    {{-- <div class="dropdown d-flex">
                        <a class="btn btn-primary d-flex align-items-center gap-1 " href="javascript:void(0)"
                            id="drop4" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-shopping-cart fs-5"></i>
                            Buy Now
                            <i class="ti ti-chevron-down fs-5"></i>
                        </a>
                    </div> --}}
                </div>
            </div>

        </div>
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('imagem/logo.png') }}" height="110" width="200">
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-6"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    {{-- aqui fica o menu --}}
                    @include('secretaria.layout_secretaria.menuSecretaria')
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-bell"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        Item 1
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        Item 2
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a class="nav-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{ asset('template/assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block" @crsf> Sair</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <!--  Row 1 -->
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center">
                                        <div>
                                            <h4 class="card-title">Agendamentos do dia</h4>

                                        </div>
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <select class="form-select theme-select border-0"
                                                aria-label="Default select example">
                                                <option value="1">March 2025</option>
                                                <option value="2">March 2025</option>
                                                <option value="3">March 2025</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card shadow-sm">
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <form action="{{ route('agendamentos.index') }}">
                                                                <div class="row">

                                                                    <div class="col-md-6 col-sm-6">
                                                                        <label class="form-label"
                                                                            for="nome">Nome</label>
                                                                        <input type="text" name="nome"
                                                                            id="nome" class="form-control"
                                                                            value="{{ $nome ?? '' }}"
                                                                            placeholder="Nome da conta" />

                                                                    </div>

                                                                    <div class="col-md-6 col-sm-6 mt-3 pt-4">
                                                                        <button type="submit"
                                                                            class="btn btn-info btn-sm">Pesquisar</button>
                                                                        <a href="{{ route('agendamentos.index') }}"
                                                                            class="btn btn-warning btn-sm">Limpar</a>
                                                                    </div>

                                                                </div>

                                                            </form>
                                                        </div>

                                                        <h5 class="card-title mb-3">Lista de Agendamentos do dia</h5>
                                                        <a href="{{ route('agendamentos.create') }}"
                                                            class="btn btn-success btn-sm w-100 card-title mb-3">Novo
                                                            Agendamento</a>
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-striped table-hover align-middle">
                                                                @if (session('sucesso_agendamento'))
                                                                    <div class="alert alert-success">
                                                                        {{ session('sucesso_agendamento') }}
                                                                    </div>
                                                                @endif
                                                                <thead class="table-dark">
                                                                    <tr>
                                                                        <th>Nº de atendimento</th>
                                                                        <th>Nome</th>
                                                                        <th>Telefone</th>
                                                                        <th>Data</th>
                                                                        <th>Horário</th>
                                                                        <th colspan="4" class="text-center">Ações
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($agendamentos_dia as $agend)
                                                                        <tr>
                                                                            <td>{{ $agend->id }}</td>
                                                                            <td>{{ $agend->pessoa->nome }}</td>
                                                                            <td>{{ $agend->pessoa->telefone }}</td>
                                                                            {{-- <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td> --}}
                                                                            <td>{{ \Carbon\Carbon::parse($agend->data_hora)->format('d/m/Y') }}
                                                                            </td>
                                                                            <td>{{ $agend->hora }}</td>
                                                                            <td> <a href="{{ route('protocolo.pdf', $agend->id) }}"
                                                                                    class="btn btn-danger btn-sm w-100"
                                                                                    target="_blank">
                                                                                    Gerar protocolo (PDF)
                                                                                </a></td>
                                                                            <td>
                                                                                <a href="{{ route('adicionando-fila', ['id' => $agend->id]) }}"
                                                                                    class="btn btn-success btn-sm w-100">
                                                                                    Fila
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <a href="{{ route('agendamentos.edit', ['agendamento' => $agend->id]) }}"
                                                                                    class="btn btn-warning btn-sm w-100">
                                                                                    Remarcação
                                                                                </a>
                                                                            </td>
                                                                            <td>
                                                                                <form
                                                                                    action="{{ route('agendamentos.destroy', $agend->id) }}"
                                                                                    method="POST"
                                                                                    style="display:inline">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger btn-sm"
                                                                                        onclick="return confirm('Tem certeza que deseja remover este agendamento?')">
                                                                                        Remover
                                                                                    </button>
                                                                                </form>
                                                                            </td>
                                                                            <!-- Formulário de exclusão -->
                                                                        </tr>
                                                                    @endforeach


                                                                </tbody>
                                                            </table>


                                                        </div>
                                                    </div>
                                                    {{ $agendamentos_dia->links() }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- aqui fica o rodape --}}
                        @include('prefeito.layout.rodape')
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('template/assets/js/app.min.js') }}"></script>
        <script src="{{ asset('template/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script src="{{ asset('template/assets/libs/simplebar/dist/simplebar.js') }}"></script>
        <script src="{{ asset('template/assets/js/dashboard.js') }}"></script>
        <!-- solar icons -->
        <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
