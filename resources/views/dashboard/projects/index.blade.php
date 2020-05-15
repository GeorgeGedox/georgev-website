@extends('dashboard.layouts.app', ['title' => __('Projects management')])

@section('content')
    @include('dashboard.partials.page.header', ['title' => __('Projects management')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Projects') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dashboard.projects.create') }}" class="btn btn-sm btn-primary">{{ __('Add project') }}</a>
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
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Tags') }}</th>
                                <th scope="col">{{ __('Created at') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <th>
                                        <div class="media align-items-center">
                                            <div class="avatar rounded-circle mr-3">
                                                <img style="height: 100%" alt="{{ $project->name }}" src="{{ $project->getFirstMediaUrl()  }}">
                                            </div>
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{ $project->name }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>{{ $project->tags }}</td>
                                    <td>{{ $project->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('dashboard.projects.destroy', $project) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="dropdown-item" href="{{ route('dashboard.projects.edit', $project) }}">{{ __('Edit') }}</a>
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this project?") }}') ? this.parentElement.submit() : ''">
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
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $projects->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.layouts.footers.auth')
    </div>
@endsection
