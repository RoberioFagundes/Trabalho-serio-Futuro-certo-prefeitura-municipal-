<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->make('titulo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('template/assets/css/styles.min.css')); ?>" />
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
                    <a href="<?php echo e(route('dashboard')); ?>" class="text-nowrap logo-img">
                        <img src="<?php echo e(asset('imagem/logo.png')); ?>" height="80" width="160" class="img-fluid">
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-6"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <?php echo $__env->make('secretaria.layout_secretaria.menuSecretaria', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                                    <img src="<?php echo e(asset('template/assets/images/profile/user-1.jpg')); ?>" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <p class="mb-0 fs-3 px-3"><?php echo e(auth()->user()->name); ?></p>
                                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
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
                                    <div class="card-body">
                                        <form action="<?php echo e(route('pessoas.index')); ?>">
                                            <div class="row">

                                                <div class="col-md-6 col-sm-6">
                                                    <label class="form-label" for="nome">Nome</label>
                                                    <input type="text" name="nome" id="nome"
                                                        class="form-control" value="<?php echo e($nome); ?>"
                                                        placeholder="Nome da conta" />
                                                </div>

                                                <div class="col-md-6 col-sm-6 mt-3 pt-4">
                                                    <button type="submit"
                                                        class="btn btn-info btn-sm">Pesquisar</button>
                                                    <a href="<?php echo e(route('pessoas.index')); ?>"
                                                        class="btn btn-warning btn-sm">Limpar</a>
                                                </div>

                                            </div>

                                        </form>
                                    </div>

                                    <h5 class="card-title mb-3">Lista de Pessoas</h5>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover align-middle">
                                            <?php if(session('sucesso_agendamento')): ?>
                                                <div class="alert alert-success">
                                                    <?php echo e(session('sucesso_agendamento')); ?>

                                                </div>
                                            <?php endif; ?>
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CPF</th>
                                                    <th>RG</th>
                                                    <th>Data de Nascimento</th>
                                                    <th>Cartão do SUS</th>
                                                    <th>Telefone</th>
                                                    <th colspan="4" class="text-center">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $pessoas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pessoa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($pessoa->nome); ?></td>
                                                        <td><?php echo e($pessoa->cpf); ?></td>
                                                        <td><?php echo e($pessoa->rg); ?></td>
                                                        <td><?php echo e($pessoa->data_nascimento); ?></td>
                                                        <td><?php echo e($pessoa->cartao_sus); ?></td>
                                                        <td><?php echo e($pessoa->telefone); ?></td>
                                                        <td>
                                                            <a href="<?php echo e(route('pessoas.edit', ['pessoa' => $pessoa->id])); ?>"
                                                                class="btn btn-warning btn-sm w-100">
                                                                Editar
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo e(route('pessoas.create')); ?>"
                                                                class="btn btn-success btn-sm w-100">
                                                                Criar
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <form action="<?php echo e(route('pessoas.destroy', $pessoa)); ?>"
                                                                method="POST"
                                                                onsubmit="return confirm('Tem certeza que deseja eliminar esta pessoa?')">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm w-100">Eliminar</button>
                                                            </form>

                                                        </td>
                                                        <td>
                                                            <a href="<?php echo e(route('agendamentos.create.pessoas.cadastradas', $pessoa->id)); ?>"
                                                                class="btn btn-primary">
                                                                Novo Agendamento
                                                            </a>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <?php echo e($pessoas->links()); ?>

                        </div>
                    </div>
                </div>

                <?php echo $__env->make('prefeito.layout.rodape', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('template/assets/libs/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/js/sidebarmenu.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/libs/simplebar/dist/simplebar.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/js/dashboard.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\sistemaagendamento\resources\views/secretaria/sistema/Pessoa/index.blade.php ENDPATH**/ ?>