@extends('layouts.master')

@section('title', $data['author']->full_name)

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
@endpush

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">

    @include('pages.shared.metas', [
        'title'         => $data['author']->full_name,
        'description'   => $data['author']->information,
        'image_url'     => $data['author']->getImage(),
    ])
@endpush

@section('content')

    <div class="container">
        <div class="single-detail">
            <div class="row">
                <div class="col-9">
                    <div class="profile-tag">
                        <figure class="profile-tag-author-image">
                            <div class="img" style="background-image: url({{ $data['author']->getImage() }})"><span class="hidden">{{ $data['author']->full_name }}</span></div>
                        </figure>
                        <div class="profile-tag-author">
                            <h2 class="profile-tag-title">{{ $data['author']->full_name }}</h2>
                            <h3 class="profile-tag-desc">{{ $data['author']->meta['description'] ?? '' }}</h3>
                            @isset ($data['author']->meta['facebook'])
                                <a class="profile-tag-soc icon-facebook-w" href="{{ $data['author']->meta['facebook'] }}"></a>
                            @endisset
                            @isset($data['author']->meta['twitter'])
                                <a class="profile-tag-soc icon-twitter-w" href="{{ $data['author']->meta['twitter'] }}"></a>
                            @endisset

                        </div>
                        <div class="profile-tag-author-meta">
                            <span class="author-location">{{ \Foundation\Builders\Cache\Meta::get('secondary_location') }}</span>
                            <span class="author-link">
									<a href="{{ author_url($data['author']->unique_identifier) }}">{{ author_url($data['author']->unique_identifier) }}</a>
								</span>
                            <span class="author-stats">{{ $data['author']->posts_count }} posts</span>
                        </div>
                    </div>


                    <div class="writer-news-post row">

                        @foreach($data['author']->posts as $post)
                            <div class="col-6">
                                <div class="enter-item">
                                    <h5><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }} </a></h5>
                                    <img class="lazy" data-src="{{ resolve_image($post->image ?? 'N/A', $post->unique_identifier) }}" alt="{{ $post->title }}">
                                    <div class="content">
                                        <p>{{ resolve_description($post->content) }}</p>
                                    </div>
                                </div>
                                <!-- /item -->
                            </div>
                            <!-- /col6 -->
                        @endforeach
                    </div>

                </div>
                <div class="col-3">

                    {!! $components['page-sidebar-component'] ?? '' !!}

                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{ asset('assets/js/author.js') }}"></script>

@endpush
