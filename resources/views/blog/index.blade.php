@extends('layout.app', ['header_class' => 'sticky'])

@section('content')
    <div class="container blog">
        <div class="row">
            <div class="col-sm-8">
                <div class="heading pb-5 pt-2">
                    <h1>Blog</h1>
                    <p>Here's where I write things about development, design, tips and tricks and other things that go trough my head during the day and the night.</p>
                </div>
            </div>
            <div class="col-sm-8 offset-sm-2">
                <div class="cards">
                    @forelse($posts as $post)
                        <div class="card">
                            <div class="title">
                                <h2><a href="{{ route('blog.view', $post->slug) }}">{{ $post->title }}</a></h2>
                                <span>Published at {{ $post->date }} &bull; <a href="{{ route('blog.view', $post->slug) }}#disqus_thread">Post a comment</a></span>
                            </div>
                            <div class="body">
                                <p>{{ $post->summary }}</p>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center">
                            <h2>Nothing to show right now.</h2>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script id="dsq-count-scr" src="//georgev-design.disqus.com/count.js" async></script>
@endpush
