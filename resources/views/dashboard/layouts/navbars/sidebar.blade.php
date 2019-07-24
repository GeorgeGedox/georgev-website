<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('images/logo.svg') }}" class="navbar-brand-img" alt="...">
        </a>

        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            @include('dashboard.partials.user')
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('dashboard.index') }}">
                            <img src="{{ asset('images/logo.svg') }}">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'dashboard.index' ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-home text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'dashboard.blog.') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-pen-nib text-info"></i> {{ __('Blog') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'dashboard.projects.') ? 'active' : '' }}" href="{{ route('dashboard.projects.index') }}">
                        <i class="fas fa-camera text-orange"></i> {{ __('Projects') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'dashboard.settings.') ? 'active' : '' }}" href="#nav-settings" data-toggle="collapse" role="button"
                       aria-expanded="{{ Str::startsWith(Route::currentRouteName(), 'dashboard.settings.') ? 'true' : 'false' }}" aria-controls="navbar-settings">
                        <i class="fas fa-cogs text-pink"></i>
                        <span class="nav-link-text">{{ __('Settings') }}</span>
                    </a>

                    <div class="collapse {{ Str::startsWith(Route::currentRouteName(), 'dashboard.settings.') ? 'show' : '' }}" id="nav-settings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() == 'dashboard.settings.general.index' ? 'active' : '' }}" href="{{ route('dashboard.settings.general.index') }}">
                                    {{ __('General') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Useful Links</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/GeorgeGedox/georgev-website" target="_blank">
                        <i class="fab fa-github"></i> Repository
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}" target="_blank">
                        <i class="fas fa-arrow-right"></i> View website
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>