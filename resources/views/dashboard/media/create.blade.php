@extends('dashboard.layouts.app', ['title' => __('Media manager')])

@section('content')
    @include('dashboard.partials.page.header', ['title' => __('Upload media')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Upload') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dashboard.media.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.media.store') }}" class="dropzone" id="media-drop">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link href="{{ asset('argon') }}/vendor/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/dropzone/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.mediaDrop = {
            maxFilesize: 10,
            acceptedFiles: 'image/*'
        };
    </script>
@endpush
