<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
    <meta name="root-path" content="{{ url('/')  }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dist/themes/artist-nepal/img/ArtistNepal-Icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dist/themes/artist-nepal/img/ArtistNepal-Icon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/themes/artist-nepal/img/ArtistNepal-Icon-32x32.png') }}">

    <title>{{ config('app.name', 'App') }} | @yield('title')</title>

    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/backend.css') }}" rel="stylesheet">
    @stack('css')
</head>
