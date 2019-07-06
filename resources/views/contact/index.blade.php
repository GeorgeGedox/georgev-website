@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="heading pb-5 pt-2">
                    <h1>Contact</h1>
                    <p>Want to talk about a project? Maybe about my development process, tooling or just to say hi? We can even talk about Game of Thrones. Here's how you can find me.</p>
                </div>
            </div>
            <div class="col-12">
                <div class="contact-block">
                    <div class="title">
                        <span>Email</span>
                    </div>
                    <div class="body">
                        <h2><a href="mailto:hi&#64;georgev.design">hi&#64;georgev.design</a></h2>
                    </div>
                </div>
                <div class="contact-block">
                    <div class="title">
                        <span>Social networks</span>
                    </div>
                    <div class="body">
                        @include('layout.social')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection