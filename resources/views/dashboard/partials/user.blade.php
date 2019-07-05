<li class="nav-item dropdown">
    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle" style="background: rgba(0, 0, 0, 0.2); font-size: 1rem">
                            <i class="ni ni-circle-08" style="top: inherit"></i>
                        </span>
            <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
        <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
        </div>
        <a href="{{ route('dashboard.profile.edit') }}" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>{{ __('My profile') }}</span>
        </a>
        <a href="#" class="dropdown-item">
            <i class="ni ni-settings-gear-65"></i>
            <span>{{ __('Settings') }}</span>
        </a>
        <a href="#" class="dropdown-item">
            <i class="ni ni-calendar-grid-58"></i>
            <span>{{ __('Activity') }}</span>
        </a>
        <a href="#" class="dropdown-item">
            <i class="ni ni-support-16"></i>
            <span>{{ __('Support') }}</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('dashboard.index') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <i class="ni ni-user-run"></i>
            <span>{{ __('Logout') }}</span>
        </a>
    </div>
</li>