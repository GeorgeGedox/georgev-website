<div class="header pb-8 pt-7 pt-lg-8 d-flex align-items-center" style="background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask {{ $bg ?? 'bg-gradient-primary' }} opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-2 text-white">{{ $title }}</h1>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-2">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>