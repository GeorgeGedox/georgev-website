@extends('dashboard.layouts.app', ['title' => __('Portfolio management')])

@section('content')
    @include('dashboard.partials.page.header', ['title' => $project->name])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit project') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dashboard.portfolio.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dashboard.portfolio.update', $project) }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Project data') }}</h6>
                                    <div class="pl-lg-3">
                                        <label class="form-control-label">{{ __('Name') }}</label>
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <input type="text" name="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"
                                                   value="{{ old('name', $project->name) }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="form-control-label">{{ __('Tags') }}</label>
                                        <div class="form-group{{ $errors->has('tags') ? ' has-danger' : '' }}">
                                            <input type="text" name="tags" class="form-control form-control-alternative{{ $errors->has('tags') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('ex: design, development, ui/ux') }}" value="{{ old('tags', $project->tags) }}" required>

                                            @if ($errors->has('tags'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tags') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="form-control-label">{{ __('Additional classes') }}</label>
                                        <div class="form-group{{ $errors->has('class') ? ' has-danger' : '' }}">
                                            <input type="text" name="class" class="form-control form-control-alternative{{ $errors->has('class') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('ex: text-light') }}" value="{{ old('class', $project->class) }}">

                                            @if ($errors->has('class'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('class') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <label class="form-control-label">{{ __('Description') }}</label>
                                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <textarea name="description" rows="10" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                      placeholder="{{ __('Describe your project') }}" required>{{ old('description', $project->description) }}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="heading-small text-muted mb-4">{{ __('Project media') }}</h6>
                                    <div class="pl-lg-3">
                                        <div class="img-wrap">
                                            <img class="img-fluid img-thumbnail" src="{{ $project->getFirstMediaUrl() }}" alt="">
                                        </div>
                                        <label class="form-control-label">{{ __('Project image') }}</label>
                                        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                            <input type="file" name="image" style="display: block">

                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush