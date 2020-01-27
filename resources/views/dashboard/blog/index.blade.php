@extends('dashboard.layouts.app', ['title' => __('Blog posts management')])

@section('content')
    @include('dashboard.partials.page.header', ['title' => __('Blog posts management')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Posts') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dashboard.blog.create') }}" class="btn btn-sm btn-primary">{{ __('New post') }}</a>
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
                                <th scope="col">ID</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('URL Slug') }}</th>
                                <th scope="col">{{ __('Created at') }}</th>
                                <th scope="col">{{ __('Updated at') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td><a href="{{ route('blog.view', $post->slug) }}" target="_blank">{{ $post->slug }}</a></td>
                                    <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $post->created_at == $post->updated_at ? "Never" : $post->updated_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('dashboard.blog.destroy', $post) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a class="dropdown-item" href="{{ route('dashboard.blog.edit', $post) }}">{{ __('Edit') }}</a>
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this post?") }}') ? this.parentElement.submit() : ''">
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
                            {{ $posts->links() }}
                        </nav>
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