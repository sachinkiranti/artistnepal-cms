<!doctype html>
<html lang="en" prefix="op: http://media.facebook.com/op#">
<head>
    <meta charset="utf-8">
    <meta property="op:markup_version" content="v1.0">
    <meta property="fb:article_style" content="default"/>
    <link rel="canonical" href="{{ route('post.single', ['slug' => $post->unique_identifier]) }}">
    <title>{{ $post->title }}</title>
</head>
<body>
<article>
    <header>
        <h1>{{  $post->title  }}</h1>
        <h2> {{ resolve_description($post->content, 200) }}</h2>
        <h3 class="op-kicker">
            {{ $post->category_name }}
        </h3>
        <address>
            {{ $post->author_full_name }}
        </address>
        <time class="op-published" dateTime="{{ optional($post->created_at)->format('c') }}">
            {{ $post->created_at->format('M d Y, h:i a') }}
        </time>
        <time class="op-modified" dateTime="{{ optional($post->updated_at)->format('c') }}">
            {{ optional($post->updated_at)->format('M d Y, h:i a') }}
        </time>
    </header>

    <figure>
        <img src="{{ resolve_image($post->image, $post->unique_identifier) }}" />
    </figure>

    {!! $post->content !!}

    <footer>
        <aside>
            {{ $post->secondary_title }}
        </aside>
        <small>{{ \Foundation\Builders\Cache\Meta::get('copyright-text') }}</small>
    </footer>
</article>
</body>
</html>
