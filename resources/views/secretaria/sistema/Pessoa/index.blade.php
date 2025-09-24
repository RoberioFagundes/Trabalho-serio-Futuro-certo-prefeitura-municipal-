<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@include('titulo')</title>
    <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Top Bar -->
        <div
            class="app-topstrip bg-dark py-3 px-3 d-flex flex-column flex-lg-row align-items-center justify-content-between">
            <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center text-lg-start">
                Prefeitura Municipal - Palmas de Monte Alto - Bahia
            </h3>
        </div>

        <!-- Sidebar -->
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('imagem/logo.png') }}" height="80" width="160" class="img-fluid">
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-6"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    @include('secretaria.layout_secretaria.menuSecretaria')
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="body-wrapper">
            <!-- Header -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>

                        <!-- Notificações -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="drop1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-bell"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                                <div class="message-body">
                                    <a href="#" class="dropdown-item">Item 1</a>
                                    <a href="#" class="dropdown-item">Item 2</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img src="{{ asset('template/assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <p class="mb-0 fs-3 px-3">{{ auth()->user()->name }}</p>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-outline-primary mx-3 mt-2 d-block">Sair</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- Conteúdo -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="col-8">
                                        <form class="d-flex" action="" method="get">
                                            <input class="form-control me-2" name="searchCaixaCliente" type="text"
                                                placeholder="Pesquisar">
                                            <input type="submit" class="btn btn-primary mx-2" value="Pesquisar">
                                        </form>
                                    </div>

                                    <h5 class="card-title mb-3">Lista de Pessoas</h5>

                                    <table class="table table-striped table-hover align-middle">
                                        @if (session('sucesso_agendamento'))
                                            <div class="alert alert-success">
                                                {{ session('sucesso_agendamento') }}
                                            </div>
                                        @endif
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Nome</th>
                                                <th>CPF</th>
                                                <th>RG</th>
                                                <th>DATA DE NASCIMENTO</th>
                                                <th>Cartão do Sus</th>
                                                <th>Telefone</th>
                                                <th colspan="4" class="text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pessoas as $pessoa)
                                                <tr>
                                                    <td>{{ $pessoa->nome }}</td>
                                                    <td>{{ $pessoa->cpf }}</td>
                                                    <td>{{ $pessoa->rg }}</td>
                                                    <td>{{ $pessoa->data_nascimento }}</td>
                                                    <td>{{ $pessoa->cartao_sus }}</td>
                                                    <td>{{ $pessoa->telefone }}</td>
                                                    <td> <a href="#" class="btn btn-danger btn-sm w-100"
                                                            target="_blank">
                                                            atualizar
                                                        </a></td>
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-sm w-100">
                                                            Criar
                                                        </a>
                                                    </td>
                                                    <td><button class="btn btn-danger btn-sm w-100">Eliminar</button>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('agendamentos.create',['id'=>$pessoa->id]) }}"
                                                            class="btn btn-success btn-sm w-100">Novo
                                                            Agendamento</a>
                                                        <div class="table-responsive">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('prefeito.layout.rodape')
            </div>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
