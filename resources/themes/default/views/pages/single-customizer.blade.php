@extends('layouts.master')

@section('title', $data['post']->title)

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .button-editor {
            background-color: #298ac2!important;
            border: none;
            color: white;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 10px;
            float: right;
            cursor: pointer;
        }

        .btn.btn-dark {
            background: #000;
        }
    </style>
@endpush

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('top-section')
    @if($data['post']->isFacebookCommentOpened())
        <div id="fb-root"></div>
        <script defer>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=1733155496987761&autoLogAppEvents=1';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
    @endif
@endsection

@section('content')
    @include('admin.appearance.customizer.widgets.partials.edit-model')
    <div class="container">
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
                                <p>
                                    {!! ($data['post']->secondary_title !== 'NULL' ? $data['post']->secondary_title : null) !!}
                                </p>
                            </div>
                            <div class="single-meta">
                                <div class="writer-info">
                                    @php
                                        $profileImage = empty($data['post']->user->user_profile_image) ? null : 'images/user/'.$data['post']->user->user_profile_image;
                                    @endphp
                                    <a href="{{ author_url($data['post']->author_identifier) }}" title="{{ $data['post']->author_full_name }}"><img loading="lazy" src="{{ asset('images/admin/user-default.png') }}" alt="pic"></a>
                                    <a href="{{ author_url($data['post']->author_identifier) }}" title="{{ $data['post']->author_full_name }}"><span>{{ ucfirst($data['post']->author_full_name) }} ,</span></a>
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
                            </div>
                        @endif
                    </div>

                    <div class="wrap-main-content">
                        <div class="main-news-content">
                            @if($image = $data['post']->image)
                                <div class="features-image">
                                    <img loading="lazy" src="{{ resolve_image($image, $data['post']->unique_identifier) }}" alt="">
                                </div>
                            @endif
                            <div class="content-news">
                                {!! $data['post']->content !!}
                            </div>
                            <!-- /content news -->

                            @if ($data['post']->isPost())
                                @include('pages.shared.single.news-writer')
                            @endif
                        </div>
                    </div>
                    <!-- /wrap main content -->
                    @if ($data['post']->isPost())
                        @include('pages.shared.share-this')

                        @if($data['post']->isReactionOpened())
                            @include('pages.shared.reaction')
                        @endif

                        @if ($data['post']->is_commentable < 3)
                            @include('pages.shared.comments',[
                                'url'           => '',
                                'identifier'    => '',
                                'webIdentifier' => 'https://http-hbkhabar-local',
                            ])
                        @endif

                        @include('pages.shared.single.related-posts')
                    @endif
                </div>
                <div class="col-3">

                    @include('pages.shared.single.page-sidebar-component-wrapper')

                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ theme_asset('js/bootstrap.min.js') }}"></script>

    <script src="{{ theme_asset('js/single.min.js') }}"></script>
    @if ($data['post']->is_commentable < 3)
    <script src="{{ theme_asset('js/feedback-manager.min.js') }}"></script>
    @endif
    @if( $propertyID = \Foundation\Builders\Cache\Meta::args('config.share_this_property'))
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property={{ $propertyID }}&product=sop' async='async'></script>
    @endif
    <script src="{{ theme_asset('js/customizer.min.js') }}"></script>
@endpush
