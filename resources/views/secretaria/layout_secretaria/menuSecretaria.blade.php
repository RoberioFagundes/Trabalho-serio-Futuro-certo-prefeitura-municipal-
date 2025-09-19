@yield('menu_secretaria')
<ul id="sidebarnav">
    <li class="nav-small-cap">
        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
        <span class="hide-menu">Home</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="./index.html" aria-expanded="false">
            <i class="ti ti-atom"></i>
            <span class="hide-menu">Dashboard</span>
        </a>
    </li>
    <!-- ---------------------------------- -->
    <!-- Dashboard -->
    <!-- ---------------------------------- -->
    <li class="sidebar-item">
        <a class="sidebar-link justify-content-between" href="{{route('agendamentos.index')}}" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
                <span class="d-flex">
                    <i class="fa fa-calendar"></i>
                </span>
                <span class="">Agendamentos</span>
            </div>

        </a>
    </li>
     <li class="sidebar-item">
        <a class="sidebar-link justify-content-between" href="#" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
                <span class="d-flex">
                    <i class="fa fa-female"></i>
                </span>
                <span class="hide-menu">Fila</span>
            </div>

        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link justify-content-between" href="#" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
                <span class="d-flex">
                    <i class="fa fa-server"></i>
                </span>
                <span class="hide-menu">Atendimentos</span>
            </div>

        </a>
    </li>

     <li class="sidebar-item">
        <a class="sidebar-link justify-content-between" href="#" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
                <span class="d-flex">
                    <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">ReAgendamento</span>
            </div>
        </a>
    </li>
    
</ul>
