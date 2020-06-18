@extends('layout.app', ['header_class' => 'sticky'])

@push('open-graph')
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="{{ route('blog.view', $post->slug) }}">
    <meta property="og:type" content="article">
@endpush

@section('content')
    <div class="container blog">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                @if(($post->draft && auth()->check()) || $post->draft == 0)
                    <div class="heading pb-5 pt-2">
                        <h1>{{ $post->title }}</h1>
                        <span style="font-size: 13px">{{ $post->date }}</span>
                    </div>
                    {{ $post->html_body }}

                    {{-- Comments --}}
                    <div id="disqus_thread"></div>
                    <script>
                        var disqus_config = function () {
                            this.page.url = "{{ route('blog.view', $post->slug) }}";
                            this.page.identifier = "{{ $post->slug }}";
                        };
                        (function() {
                            var d = document, s = d.createElement('script');
                            s.src = 'https://georgev-design.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                @else
                    <div class="heading pb-5 pt-2">
                        <h1>Cannot access this post</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
