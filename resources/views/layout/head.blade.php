<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ App\Classes\Helpers::setting('general_seo_description', '') }}">
    @stack('open-graph')

    <title>{{ App\Classes\Helpers::setting('general_seo_title', 'Website design & development') }} - {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {!! App\Classes\Helpers::setting('general_seo_tracking') !!}

    {{-- Fix blank screen flicker --}}
    <style>html{display: none;touch-action: manipulation}</style>
</head>
