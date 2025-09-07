<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @stack('metas')
    <title>{{ \Foundation\Builders\Cache\Meta::get('company') }} | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Mukta:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ theme_asset('css/app.min.css') }}">
    @stack('styles')
</head>
