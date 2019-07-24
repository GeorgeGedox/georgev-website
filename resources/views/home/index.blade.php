@extends('layout.app', ['body_class' => 'home', 'nav_class' => 'nav-light'])

@section('content')
    <div id="feature-panel">
        <div id="backdrop"></div>
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-lg-6 order-1 order-lg-0">
                    <div class="info">
                        <h4 class="anim-fadeIn">Hey! I’m <strong>George</strong></h4>
                        <p class="anim-fadeIn anim-delay-1">A <strong>web designer</strong> and <strong>full-stack developer</strong> based in Bucharest,
                            Romania.
                        </p>

                        <div class="action anim-slideInUp anim-delay-2">
                            <a href="{{ route('projects') }}" class="btn btn-primary btn-big">Portfolio</a>
                            @include('layout.social')
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-0 order-lg-1 laptop-wrapper">
                    <div class="laptop">
                        <img src="{{ asset('images/laptop.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection