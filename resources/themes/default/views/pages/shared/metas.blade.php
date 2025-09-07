    <meta property="fb:app_id" content="{{ \Foundation\Builders\Cache\Meta::args('config.facebook_app_id') }}" />
    <meta property="og:site_name" content="{{ \Foundation\Builders\Cache\Meta::get('company') }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $image_url }}">
    <meta property="og:url" content="{{ url()->current() }}">

    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $image_url }}">
    <meta name="twitter:card" content="{{ $image_url }}">
    <meta name="twitter:site" content="@himalayaakhabar">
    <meta name="twitter:image:alt" content="{{ $title }}">

    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords ?? $title }}">
    <meta name="author" content="{{ \Foundation\Builders\Cache\Meta::get('company') }}">
