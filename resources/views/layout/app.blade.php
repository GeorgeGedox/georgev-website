<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layout.head')
<body @if(!empty($body_class))class="{{ $body_class }}"@endif>
<header @if(!empty($header_class))class="{{ $header_class }}"@endif>
    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <svg viewBox="0 0 277 71.5" preserveAspectRatio="meet">
                        <defs>
                            <filter id="a" width="58.469" height="71.5" x="268.531" y="48.5" filterUnits="userSpaceOnUse">
                                <feImage width="58.469" height="71.5" x="268.531" y="48.5" preserveAspectRatio="none" result="image" xlink:href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNTguNDY5IiBoZWlnaHQ9IjcxLjUiIHZpZXdCb3g9IjAgMCA1OC40NjkgNzEuNSI+CiAgPGRlZnM+CiAgICA8c3R5bGU+CiAgICAgIC5jbHMtMSB7CiAgICAgICAgb3BhY2l0eTogMC42MzsKICAgICAgICBmaWxsOiB1cmwoI2xpbmVhci1ncmFkaWVudCk7CiAgICAgIH0KICAgIDwvc3R5bGU+CiAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImxpbmVhci1ncmFkaWVudCIgeDE9IjI5LjIzNCIgeTE9IjcxLjUiIHgyPSIyOS4yMzQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj4KICAgICAgPHN0b3Agb2Zmc2V0PSItMC4xOTUiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSIxLjE5NSIgc3RvcC1jb2xvcj0iI2ZmZiIvPgogICAgPC9saW5lYXJHcmFkaWVudD4KICA8L2RlZnM+CiAgPHJlY3QgY2xhc3M9ImNscy0xIiB3aWR0aD0iNTguNDY5IiBoZWlnaHQ9IjcxLjUiLz4KPC9zdmc+Cg=="/>
                                <feComposite in2="SourceGraphic" operator="in" result="composite"/>
                                <feBlend in2="SourceGraphic" mode="overlay" result="blend"/>
                            </filter>
                        </defs>
                        <path fill="#32324a" fill-rule="evenodd" d="M38.809 30.884C36.688 20.258 27.4 16.316 19.717 16.316c-11.065 0-19.722 8.455-19.722 20.281 0 11.769 8.485 20.224 19.722 20.224 7.281 0 15.537-4.913 18.289-12.568v.057A28.608 28.608 0 0 0 39.1 37.4H17.481v5.77H32.33c-2.408 5.827-7.683 8.112-12.613 8.112-7.855 0-13.932-6.227-13.932-14.682 0-8.4 6.077-14.511 13.932-14.511 5.1 0 11.295 2.342 12.9 8.8h6.192zm10.267 8.569h18.175v-5.826H49.076V22.372h18.576V16.6H43.228v39.933h24.481v-5.77H49.076V39.454zm56.361-2.914a14.655 14.655 0 0 1-14.62 14.682 14.415 14.415 0 0 1-10.262-4.342 14.583 14.583 0 0 1 0-20.681 14.415 14.415 0 0 1 10.262-4.342 14.655 14.655 0 0 1 14.62 14.684zm-35.03 0a20.731 20.731 0 0 0 5.962 14.454 20.33 20.33 0 0 0 28.953 0 20.5 20.5 0 0 0 0-28.908 20.331 20.331 0 0 0-28.953 0 20.731 20.731 0 0 0-5.962 14.455zM123.961 39l14.62 17.538h7.51l-12.67-15.028A12.05 12.05 0 0 0 143.8 29.285c0-6.341-4.357-12.74-13.072-12.74h-14.62v39.99h5.734V22.372h8.886c4.873 0 7.281 3.485 7.281 6.913 0 3.485-2.408 6.97-7.281 6.97h-6.765V39zm60.891-8.112c-2.121-10.626-11.409-14.568-19.091-14.568-11.066 0-19.723 8.455-19.723 20.281 0 11.769 8.485 20.224 19.723 20.224 7.281 0 15.537-4.913 18.289-12.568v.053a28.628 28.628 0 0 0 1.089-6.913h-21.614v5.77h14.849c-2.408 5.827-7.683 8.112-12.613 8.112-7.855 0-13.932-6.227-13.932-14.682 0-8.4 6.077-14.511 13.932-14.511 5.1 0 11.294 2.342 12.9 8.8h6.192zm10.268 8.569h18.174v-5.83H195.12V22.372h18.58V16.6h-24.428v39.933h24.481v-5.77H195.12V39.454z"/>
                        <path fill="#3d21cc" fill-rule="evenodd" d="M298.236 120.006h-7.575l-22.124-55h11.208l14.7 36.84 21.5-53.349H327z" filter="url(#a)" transform="translate(-50 -48.5)"/>
                    </svg>
                </a>
            </div>
            <div class="navigation {{ !empty($nav_class) ? $nav_class : '' }}">
                @include('layout.navigation')
                <div class="mobile-handler">
                    <button type="button"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="navigation-mobile">
    <div class="handler">
        <button type="button"><i class="fas fa-times"></i></button>
    </div>
    <div class="items">
        @include('layout.navigation')
    </div>
</div>

<main>
    @yield('content')
</main>

@include('cookieConsent::index')

<footer>
    <p>&copy; {{ now()->year }} georgev.design</p>
</footer>

<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
