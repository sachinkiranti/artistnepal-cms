<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
    <meta name="root-path" content="{{ url('/')  }}">
    <title>{{ config('app.name', 'App') }} | @yield('title')</title>

    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/backend.css') }}" rel="stylesheet">
    @stack('css')
</head>
