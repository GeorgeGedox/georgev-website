@extends('dashboard.layouts.app', ['title' => __('Media manager')])

@section('content')
    @include('dashboard.partials.page.header', ['title' => __('Media manager')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Media') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dashboard.media.create') }}" class="btn btn-sm btn-primary">{{ __('Add media') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @include('dashboard.partials.alert')
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Image') }}</th>
                                <th scope="col">{{ __('Size') }}</th>
                                <th scope="col">{{ __('Added at') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($uploads as $upload)
                                <tr>
                                    <th>
                                        <div class="media align-items-center">
                                            <div class="avatar rounded-circle mr-3">
                                                <img style="height: 100%" alt="" src="{{ $upload['url']  }}">
                                            </div>
                                        </div>
                                    </th>
                                    <td>{{ $upload['size'] }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($upload['added'])->format('d/m/Y H:i') }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('dashboard.media.delete') }}" method="post">
                                                    @csrf
                                                    <input hidden type="text" name="path" value="{{ $upload['path'] }}">
                                                    @method('delete')
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this image?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="99">{{ __('Nothing to show') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection
