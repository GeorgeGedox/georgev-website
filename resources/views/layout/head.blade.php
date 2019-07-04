<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title', 'Web design & development')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- Fix blank screen flicker --}}
    <style>html{display: none;touch-action: manipulation}</style>
</head>