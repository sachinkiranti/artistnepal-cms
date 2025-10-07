@extends('layouts.master')

@section('title', '')

@section('promo-banner', $data['profile']->getBannerImage())

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="page-title  uk-heading-primary" style="color: white;">{{ $data['user']->getFullName() }}</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')
    <hr class="pr__vr__section">

    <section class="pr__clients pr__section uk-section uk-section-large" id="pr__clients">
        <div class="uk-container">
            <div class="section-outer">
                <div class="uk-flex uk-flex-middle uk-grid uk-grid-large" data-uk-grid="">
                    <div class="right uk-width-expand">
                        <div class="section-heading">
                            <div class="inner">
                                <div class="left">
                                    <hr class="line pr__hr__secondary">
                                    <div>
                                        <h2 class="title uk-h1 "
                                            style="display: inline-block">{{ $data['user']->getFullName() }}</h2>
                                    </div>

                                    <span class="subtitle pr__heading__secondary">{{ ucwords($data['category']?->category_name) }}</span></div>

                                <div class="right">
                                    <a href="{{ url('/') }}"
                                       class="button uk-button uk-button-large uk-button-default uk-margin-top login-required">Login
                                        to Follow</a></div>
                            </div>
                        </div>
                        <div class="pr__entry__sidebar uk-width-1-5@l uk-flex-first@l uk-hidden@m">
                            <div class="pr__entry__meta pr__vr">
                                <ul class="content uk-list uk-list-divider">
                                    <li class="author">
                                        <strong>Artist Name:</strong>
                                        <span>{{ $data['user']->getFullName() }}</span>
                                    </li>
                                    <li class="date">
                                        <strong>Profession</strong>
                                        <span>{{ ucwords($data['category']?->category_name) }}</span>
                                    </li>
                                    <li>
                                    </li>
                                </ul>
                            </div>
                            <div class="pr__entry__share pr__small">
                            </div>
                            <br/>
                        </div>
                        <div class="section-inner">
                            <div class="item client-box style-one">
                                <div class="outer">
                                    <div class="inner">
                                        <div class="description">
                                            {!! $data['profile']->bio !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left uk-width-2-5@m uk-flex-first">
                        <div class="item client-box style-one client-image">
                            <div class="image pr__image__cover pr__ratio__portrait"
                                 data-src="{{ $data['user']->getImage() }}"
                                 data-uk-img=""></div>
                        </div>
                    </div>
                </div><!-- Grid End -->
            </div><!-- Outer End -->
        </div><!-- Container End -->
    </section>

    <hr class="pr__vr__section">

    <div class="pr__primary uk-section uk-section-medium" id="site-primary">
        <div class="outer">
            <div class="uk-container uk-position-relative">
                <div class="inner uk-grid uk-grid-large uk-grid-match" data-uk-grid="">
                    <div class="uk-width-expand">
                        <main class="pr__main" id="site-main">
                            <article class="uk-article post type-post single-post">

                                <div class="outer uk-grid uk-grid-large uk-flex" data-uk-grid="">
                                    <div class="inner uk-width-expand">

                                        <main class="pr__main" id="site-main">
                                            <article class="uk-article page type-page">
                                                <div class="outer">
                                                    <div class="inner">
                                                        <h5 class="uk-h4">My Experiences</h5>
                                                    </div>
                                                </div>
                                                {!! $data['profile']->experiences !!}
                                            </article>
                                        </main>

                                        @include('pages.partials.artist-single.gallery')
                                    </div>
                                    <div class="pr__entry__sidebar uk-width-1-5@l uk-flex-first@l">
                                        <div class="pr__entry__meta pr__vr">
                                            <ul class="content uk-list uk-list-divider">
                                                <li class="author">
                                                    <strong>Artist Name:</strong>
                                                    <span>{{ $data['user']->getFullName() }}</span>
                                                </li>
                                                <li class="date">
                                                    <strong>Profession</strong>
                                                    <span>{{ ucwords($data['category']?->category_name) }}</span>
                                                </li>
                                                <li>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="pr__entry__share pr__small">
                                        </div>
                                    </div>
                                </div>

                            </article>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('pages.partials.artist-single.similar-artists')

    @include('shared.login-popup')
@endsection

@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        @media only screen and (min-width: 1200px) {
            .gallery-wrap {
                width: calc(100vw - 25%);
                margin-left: calc(-50vw + 50%);
            }
        }

        .grid-item {
            width: calc(33.33% - 20px);
            padding: 10px;
        }

        @media only screen and (max-width: 769px) {
            .grid-item {
                width: calc(50% - 10px);
                padding: 5px;
            }
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('dist/themes/artist-nepal/js/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('dist/themes/artist-nepal/js/masonry.pkgd.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script>
        $(function () {
            var grids = document.querySelectorAll('.gallery-grid');
            grids.forEach(function (grid) {
                var msnry;
                imagesLoaded(grid, function () {
                    // init Isotope after all images have loaded
                    msnry = new Masonry(grid, {
                        itemSelector: '.grid-item',
                        //columnWidth: '.grid-sizer',
                        percentPosition: true,
                        //gutter: 10
                    });
                });
            });
        })
    </script>
@endpush
