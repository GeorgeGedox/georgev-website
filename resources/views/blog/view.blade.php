@extends('layout.app', ['header_class' => 'sticky'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="heading pb-5 pt-2">
                    <h1>{{ $post->title }}</h1>
                    <span style="font-size: 13px">{{ $post->date }}</span>
                </div>
                {{ $post->html_body }}
            </div>
        </div>
    </div>
@endsection