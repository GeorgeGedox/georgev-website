@extends('dashboard.layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('dashboard.partials.page.header', [
        'bg' => 'bg-gradient-default',
        'title' => __('General settings')
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('General settings') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">

                        <hr>
                        <h6 class="heading-small text-muted mb-4">{{ __('Maintenance Mode') }}</h6>
                        <div class="pl-lg-3">
                            <form method="post" action="{{ route('dashboard.settings.general.maintenance') }}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-control-label">{{ __('Message') }}</label>
                                        <div class="form-group{{ $errors->has('message') ? ' has-danger' : '' }}">
                                            <input type="text" name="message" class="form-control form-control-alternative{{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Message') }}"
                                                   value="{{ old('message') }}">

                                            @if ($errors->has('message'))
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('message') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            @if(app()->isDownForMaintenance())
                                                <button type="submit" class="btn btn-danger mt-4">{{ __('Disable') }}</button>
                                            @else
                                                <button type="submit" class="btn btn-success mt-4">{{ __('Enable') }}</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Social links') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection