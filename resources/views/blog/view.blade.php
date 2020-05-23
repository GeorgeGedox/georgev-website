@extends('layout.app', ['header_class' => 'sticky'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                @if($post->draft && auth()->check())
                    <div class="heading pb-5 pt-2">
                        <h1>{{ $post->title }}</h1>
                        <span style="font-size: 13px">{{ $post->date }}</span>
                    </div>
                    {{ $post->html_body }}
                @else
                    <div class="heading pb-5 pt-2">
                        <h1>Cannot access this post</h1>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
