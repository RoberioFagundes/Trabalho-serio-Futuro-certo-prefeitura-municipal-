<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->make('titulo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('template/assets/css/styles.min.css')); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Inputmask -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
   
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

                    
                </div>
            </div>

        </div>
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="<?php echo e(asset('imagem/logo.png')); ?>" height="110" width="200">
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-6"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    
                    <?php echo $__env->make('secretaria.layout_secretaria.menuSecretaria', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                                    <img src="<?php echo e(asset('template/assets/images/profile/user-1.jpg')); ?>" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>

                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">

                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <p class="mb-0 fs-3"><?php echo e(auth()->user()->name); ?></p>
                                        </a>

                                        <a href="<?php echo e(route('logout')); ?>"
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
                                            <?php echo $__env->yieldContent('formulario_secretaria'); ?>
                                        </div>

                                    </div>


                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php echo $__env->make('prefeito.layout.rodape', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <script src="<?php echo e(asset('template/assets/libs/jquery/dist/jquery.min.js')); ?>"></script>
                <script src="<?php echo e(asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
                <script src="<?php echo e(asset('template/assets/js/sidebarmenu.js')); ?>"></script>
                <script src="<?php echo e(asset('template/assets/js/app.min.js')); ?>"></script>
                <script src="<?php echo e(asset('template/assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
                <script src="<?php echo e(asset('template/assets/libs/simplebar/dist/simplebar.js')); ?>"></script>
                <script src="<?php echo e(asset('template/assets/js/dashboard.js')); ?>"></script>
                <!-- solar icons -->
                <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\sistemaagendamento\resources\views/secretaria/layout_secretaria/pagina_inicialSecretaria.blade.php ENDPATH**/ ?>