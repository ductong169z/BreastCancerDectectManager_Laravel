<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index') }}">
       <img class="sidebar-brand-icon" width="50" height="50" src="{{url('img/logo_menu.png')}}" />
        <div class="sidebar-brand-text mx-2">BreastCancer Detection</div>
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
    @can('permissions.index')
        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('permissions.*') }}">
            <a class="nav-link" href="{{ route('permissions.index') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Permissions Management') }}</span>
            </a>
        </li>
        @endif
        @can('roles.index')
            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Nav::isRoute('roles.*') }}">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Roles Management') }}</span>
                </a>
            </li>
            @endif


            @can('users.index')
                <!-- Nav Item - Users Management -->
                <li class="nav-item {{ Nav::isRoute('users.*') }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Users Management') }}</span>
                    </a>
                </li>
                @endif
                @can('predict.index')
                    <!-- Nav Item - Profile -->
                    <li class="nav-item {{ Nav::isRoute('predict.*') }}">
                        <a class="nav-link" href="{{ route('predict.index') }}">
                            <i class="fas fa-fw fa-user"></i>
                            <span>{{ __('Predictions Management') }}</span>
                        </a>
                    </li>
                    @endif
                    @can('models.index')
                        <li class="nav-item {{ Nav::isRoute('models.*') }}">
                            <a class="nav-link" href="{{ route('models.index') }}">
                                <i class="fas fa-fw fa-user"></i>
                                <span>{{ __('Models Management') }}</span>
                            </a>
                        </li>
                        @endif
                        @can('patients.index')
                            <!-- Nav Item - Patient Management -->
                            <li class="nav-item {{ Nav::isRoute('patients.*') }}">
                                <a class="nav-link" href="{{ route('patients.index') }}">
                                    <i class="fas fa-fw fa-user"></i>
                                    <span>{{ __('Patient Management') }}</span>
                                </a>
                            </li>
                            @endif
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
