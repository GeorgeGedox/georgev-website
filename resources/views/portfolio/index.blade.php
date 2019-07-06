@extends('layout.app', ['header_class' => 'sticky'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="heading pb-5 pt-2">
                    <h1>Portfolio</h1>
                    <p>Here I list projects that I've worked on and favorites that never went further than the design phase.</p>
                    @include('layout.social')
                </div>
            </div>
            <div class="col-12">
                <div class="gallery row">
                    @forelse($projects as $project)
                        <div class="img-wrap col-sm-6 col-md-4 {{ $project->class ?? '' }}">
                            <div class="image" data-id="{{ $project->id }}" style="background-image: url('{{ $project->getFirstMediaUrl() }}')">
                                <div class="text">
                                    <h3>{{ $project->name }}</h3>
                                    <span>{{ $project->tags }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div style="text-align: center">
                                <h2>Nothing to show right now.</h2>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @foreach($projects as $project)
    <div class="work-viewer" data-id="{{ $project->id }}">
        <div class="container-fluid">
            <div class="row">
                <div class="image col-8" style="background-image: url('{{ $project->getFirstMediaUrl() }}')"></div>
                <div class="info col-4">
                    <h1>{{ $project->name }}</h1>
                    <p><small>{{ $project->tags }}</small></p>
                    <p>{{ $project->description }}</p>
                    <div class="action">
                        <a href="{{ $project->getFirstMediaUrl() }}" target="_blank" title="{{ __('View full image') }}"><i class="fas fa-expand"></i></a>
                        <button class="btn btn-primary btn-no-shadow view-close" type="button">Go back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection