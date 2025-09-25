<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="Xc3YSac_2y2ElL-sGX2xcTprtcIe9VkeZqmWCFldIgA" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dist/themes/artist-nepal/img/ArtistNepal-Icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dist/themes/artist-nepal/img/ArtistNepal-Icon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dist/themes/artist-nepal/img/ArtistNepal-Icon-32x32.png') }}">
    <link rel="manifest" href="https://artistnepal.com/site.webmanifest">
    <link rel="mask-icon" href="https://artistnepal.com/safari-pinned-tab.svg?v=1.1" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#e9204f">
    <meta name="theme-color" content="#e9204f">

    <title>ArtistNepal &#8211; ArtistNepal&#039;s login or Sign Up | Where Professional Artists Meet &#8211; find
        musicians, actors, models, dancers, photographers, and directors | Nepal&#039;s 1st Online Database &amp;
        Portfolio Management site for Nepali Artists.</title>
    <meta name='robots' content='max-image-preview:large' />

    @include('layouts.partials.styles')
    <link rel="canonical" href="{{ url('/') }}" />
</head>

<body class="home wp-singular page-template-default page page-id-439 wp-theme-artistnepal @yield('body-class')">

    @include('layouts.partials.primary-mobile-nav')

    <div class="pr__wrapper" id="site-wrapper">
        @include('layouts.partials.header')

        <div class="pr__content" id="site-content">

            @yield('content')

            @include('layouts.partials.footer')
        </div>
    </div>

@include('layouts.partials.scripts')
</body>

</html>
