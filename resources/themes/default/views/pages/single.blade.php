@extends('layouts.master')

@section('title', $data['post']->title)

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{ theme_asset('css/gallery.min.css') }}">

    <style>
        .content-news > div:nth-child(2)::first-letter {
            font-size: 55px;
            font-weight: 700;
        }
    </style>
@endpush

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">

    @include('pages.shared.metas', [
        'title'         => $data['post']->title,
        'description'   => $data['post']->seo_desc ?? $data['post']->title,
        'keywords'      => $data['post']->seo_keywords,
        'image_url'     => resolve_image(!empty($data['post']->image) ? $data['post']->image : 'unidentified.png', $data['post']->unique_identifier),
    ])
@endpush

@section('top-section')
    @if($data['post']->isFacebookCommentOpened())
        @if ($appID = \Foundation\Builders\Cache\Meta::args('config.facebook_app_id'))
            <div id="fb-root"></div>
            <script defer>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId={{ $appID }}&autoLogAppEvents=1';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
        @endif
    @endif
@endsection

@section('content')
    <div class="container">

        @if(\Foundation\Builders\Cache\Meta::get('is_single_page_popup_ads_enabled'))
            <div class="adv adv-full">
                <a href="{{ \Foundation\Builders\Cache\Meta::get('single_page_popup_ads') ?? 'javascript:void(0)' }}" title="">
                    <img src="{{ asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('single_page_popup_ads')) }}" alt="adv-2">
                </a>
            </div>
        @endif
        <div class="single-detail">
            <div class="row">
                <div class="col-9">
                    <div class="detail-head">
                        @if($category = $data['post']->category_name)
                            <span class="cat-name bg-blue-light" style="color: #ffffff;">
                            {{ $data['post']->category_full_name ?? $data['post']->category_name }}
                        </span>
                        @endif
                        <h1>{{ $data['post']->title }}</h1>

                        @if ($data['post']->isPost())
                            <div class="short-content">
                                {!! ($data['post']->secondary_title !== 'NULL' ? $data['post']->secondary_title : null) !!}
                                </p>
                            </div>
                            <div class="single-meta">
                                <div class="writer-info">
                                    @php
                                        $profileImage = empty($data['post']->user->user_profile_image) ? null : 'images/user/'.$data['post']->user->user_profile_image;
                                    @endphp
                                    <a href="{{ author_url($data['post']->author_identifier) }}" title="{{ $data['post']->author_full_name }}"><img loading="lazy" src="{{ $data['post']->user->getImage() }}" alt="pic"></a>
                                    <a href="{{ author_url($data['post']->author_identifier) }}" title="{{ $data['post']->author_full_name }}"><span>{{ ucfirst($data['post']->author ?? $data['post']->author_full_name) }} ,</span></a>
                                </div>
                                @php
                                    $nepaliDate = \Kiranti\Lib\Date::convert(
                                        $data['post']->created_at->format('Y'),
                                        $data['post']->created_at->format('m'),
                                        $data['post']->created_at->format('d')
                                    );
                                @endphp
                                <span class="publish-date">{{ __('प्रकाशित') }}
                                        <time datetime="{!! $nepaliDate !!}"> {!! $nepaliDate !!}</time> |  <time datetime="{{ $data['post']->created_at->format('Y-m-d h:i:s') }}">{{ $data['post']->created_at->format('Y-m-d h:i:s') }}</time>
                                    </span>
                                @include('pages.shared.share-this')
                            </div>
                        @endif
                    </div>

                    <div class="wrap-main-content">
                        <div class="main-news-content">
                            <div class="content-news">
                                <div class="features-image">
                                    @php $mediaDisplayType = $data['post']->media_display_type; @endphp
                                    @switch($mediaDisplayType)
                                        @case('0')
                                        @if($image = $data['post']->image)
                                            <div class="features-image sub-f_img">
                                                <img class="small-sq-imgs" loading="lazy" style="margin-bottom: 10px;" src="{{ resolve_image($image, $data['post']->unique_identifier) }}" alt="">
                                                @if (optional($data['post'])->featured_news_caption)
                                                    <div class="caption">{{ optional($data['post'])->featured_news_caption }}</div>
                                                @endif
                                            </div>
                                        @endif
                                        @break

                                        @case('3')
                                        @php $fbVideoUrl = \Foundation\Lib\Utility::parseFacebookUrl($data['post']->video_url); @endphp
                                        @if($fbVideoUrl)
                                            <iframe src="{{ $fbVideoUrl }}" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                                        @endif
                                        @break

                                        @case('1')
                                        @if($videoUrl = \Foundation\Lib\Utility::parseYoutubeID($data['post']->video_url))
                                            <iframe src="https://www.youtube.com/embed/{{ $videoUrl }}?rel=0&amp;hd=0" width="100%" height="400" class="embed-responsive-item">&nbsp;</iframe>
                                        @endif
                                        @break

                                        @default
                                        @if($image = $data['post']->image)
                                            <div class="features-image sub-f_img">
                                                <img class="small-sq-imgs" loading="lazy" style="margin-bottom: 10px;" src="{{ resolve_image($image, $data['post']->unique_identifier) }}" alt="">
                                                @if (optional($data['post'])->featured_news_caption)
                                                    <div class="caption">{{ optional($data['post'])->featured_news_caption }}</div>
                                                @endif
                                            </div>
                                            <br>
                                        @endif
                                        @if($videoUrl = \Foundation\Lib\Utility::parseYoutubeID($data['post']->video_url))
                                            <br>
                                            <iframe src="https://www.youtube.com/embed/{{ $videoUrl }}?rel=0&amp;hd=0" width="100%" height="400" class="embed-responsive-item">&nbsp;</iframe>
                                            <br>
                                        @endif
                                        @php $fbVideoUrl = \Foundation\Lib\Utility::parseFacebookUrl($data['post']->video_url); @endphp
                                        @if($fbVideoUrl)
                                            <br>
                                            <iframe src="{{ $fbVideoUrl }}" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                                        @endif

                                    @endswitch
                                </div>
                                {!! $data['post']->content !!}
                            </div>
                            <!-- /content news -->
                        </div>
                        @if ($data['pictures']->isNotEmpty())
                            <section class="hk-gallery" style="padding: 0;">
                                <div class="container">
                                    <ul id="lightgallery" class="list-unstyled row">
                                        @forelse($data['pictures'] as $picture)
                                            <li class="col-lg-12" data-src="{{ $picture->image }}" data-sub-html="{{$picture->caption}}">
                                                <figure>
                                                    <a href="javascript:void(0);">
                                                        <img class="img-responsive" src="{{ $picture->image }}"  alt="{{ $picture->caption }}">
                                                    </a>
                                                </figure>
                                            </li>
                                        @empty
                                            <p class="text-center">No Images !</p>
                                        @endforelse
                                    </ul>
                                </div>
                            </section>
                        @endif
                        @if ($data['post']->isPost())
                            @include('pages.shared.single.news-writer')
                        @endif
                    </div>
                    <!-- /wrap main content -->
                    @if ($data['post']->isPost())
                        @include('pages.shared.share-this')

                        @if($data['post']->isReactionOpened())
                            @include('pages.shared.reaction')
                        @endif

                        @if ($data['post']->is_commentable < 3)
                            @include('pages.shared.comments',[
                                'url'           => url('/'),
                                'identifier'    => $data['post']->unique_identifier,
                                'webIdentifier' => 'https://http-hbkhabar-local',
                            ])
                        @endif

                        @include('pages.shared.single.related-posts')
                    @endif
                </div>
                <div class="col-3">

                    {!! $components['page-sidebar-component'] ?? '' !!}

                </div>

            </div>
        </div>
    </div>
    <div id="overlay-wrapper"></div>
@endsection

@push('scripts')
    <script src="{{ theme_asset('js/single.min.js') }}"></script>
    <script src="{{ theme_asset('js/feedback-manager.min.js') }}"></script>

    @if( $propertyID = \Foundation\Builders\Cache\Meta::args('config.share_this_property'))
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property={{ $propertyID }}&product=sop' async='async'></script>
    @endif

    <script src="{{ theme_asset('js/gallery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#lightgallery').lightGallery();
        });
    </script>
@endpush
