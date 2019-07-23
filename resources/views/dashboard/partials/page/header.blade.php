<div class="header pb-8 pt-7 pt-lg-8 d-flex align-items-center" style="background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask {{ $bg ?? 'bg-gradient-primary' }} opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row flex-fill">
            <div class="col-md-12">
                <h1 class="display-2 text-white">{{ $title }}</h1>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-2">{{ $description }}</p>
                @endif
            </div>
            <div class="col-12">
                @if(app()->isDownForMaintenance())
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> {{ __("Maintenance mode is enabled!") }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>