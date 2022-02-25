<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laptop-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BreastCancer Detection</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('home') }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>
    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('permissions.index') }}">
        <a class="nav-link" href="{{ route('permissions.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Permissions Management') }}</span>
        </a>
    </li>
    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('predict.index') }}">
        <a class="nav-link" href="{{ route('predict.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Prediction Management') }}</span>
        </a>
    </li>
    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('roles.index') }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Roles Management') }}</span>
        </a>
    </li>
    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('users.index') }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Users Management') }}</span>
        </a>
    </li>
    <li class="nav-item {{ Nav::isRoute('models.index') }}">
        <a class="nav-link" href="{{ route('models.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Models Management') }}</span>
        </a>
    </li>
    <!-- Nav Item - About -->
    <li class="nav-item {{ Nav::isRoute('about') }}">
        <a class="nav-link" href="{{ route('about') }}">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>{{ __('About') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
