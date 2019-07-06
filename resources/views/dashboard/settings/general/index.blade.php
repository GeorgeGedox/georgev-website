@extends('dashboard.layouts.app', ['title' => __('General settings')])

@section('content')
    @include('dashboard.partials.page.header', [
        'bg' => 'bg-gradient-default',
        'title' => __('General settings')
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                @include('dashboard.partials.alert')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('General settings') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="heading-small text-muted mb-2">{{ __('SEO') }}</h6>
                        <div class="pl-lg-3">
                            <form method="post" action="{{ route('dashboard.settings.general.seo') }}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-control-label">{{ __('Homepage title') }}</label>
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <input type="text" name="title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                   placeholder="{{ __('Title') }}"
                                                   value="{{ old('title', setting('general_seo_title')) }}">

                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <label class="form-control-label">{{ __('Meta description') }}</label>
                                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                            <textarea name="description" rows="5" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                      placeholder="{{ __('Describe your website') }}">{{ old('description', setting('general_seo_description')) }}</textarea>


                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-2">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <h6 class="heading-small text-muted mb-2">{{ __('Maintenance Mode') }}</h6>
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
                                                <button type="submit" class="btn btn-danger mt-2">{{ __('Disable') }}</button>
                                            @else
                                                <button type="submit" class="btn btn-success mt-2">{{ __('Enable') }}</button>
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
                        @if ($errors->has('social.*'))
                            <div class="alert alert-danger">
                                <ul class="list-unstyled" style="margin: 0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form id="socialForm" method="post" action="{{ route('dashboard.settings.general.social') }}" autocomplete="off">
                            @csrf
                            <div class="social-input-wrapper">
                                @forelse(setting('general_social', []) as $index => $item)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="social[{{ $index }}][name]" class="form-control form-control-alternative" value="{{ $item['name'] }}"
                                                       placeholder="{{ __('Name') }}" data-lpignore="true">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="social[{{ $index }}][icon]" class="form-control form-control-alternative" value="{{ $item['icon'] }}"
                                                       placeholder="{{ __('Icon') }}" data-lpignore="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="social[{{ $index }}][url]" class="form-control form-control-alternative" value="{{ $item['url'] }}"
                                                       placeholder="{{ __('URL') }}" data-lpignore="true">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="social[0][name]" class="form-control form-control-alternative" placeholder="{{ __('Name') }}" data-lpignore="true">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="social[0][icon]" class="form-control form-control-alternative" placeholder="{{ __('Icon') }}" data-lpignore="true">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="social[0][url]" class="form-control form-control-alternative" placeholder="{{ __('URL') }}" data-lpignore="true">
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success mt-2">{{ __('Save') }}</button>
                                        <button type="button" class="btn btn-primary mt-2 add-field">{{ __('Add field') }}</button>
                                    </div>
                                </div>
                            </div>
                            @push('js')
                                <script>
                                    $(document).ready(function () {
                                        const $form = $('#socialForm');
                                        const $wrapper = $('.social-input-wrapper');

                                        $form.find('button.add-field').on('click', function () {
                                            let $clone = $wrapper.find('>.row:first-child').clone(true).appendTo($wrapper);
                                            $clone.find('input').val('');

                                            $wrapper.find('.row').each(function (index) {
                                                let prefix = "social[" + index + "]";
                                                $(this).find("input").each(function () {
                                                    this.name = this.name.replace(/social\[\d+\]/, prefix);
                                                });
                                            });
                                        });
                                    });
                                </script>
                            @endpush
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection