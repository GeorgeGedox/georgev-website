<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>

        <div class="mr-3 d-none d-md-flex ml-lg-auto"></div>

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            @if(app()->isDownForMaintenance())
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="{{ route('dashboard.settings.general.index') }}">
                        <span class="badge badge-pill badge-primary">{{ __("Maintenance mode") }}</span>
                    </a>
                </li>
            @endif
            @include('dashboard.partials.user')
        </ul>
    </div>
</nav>