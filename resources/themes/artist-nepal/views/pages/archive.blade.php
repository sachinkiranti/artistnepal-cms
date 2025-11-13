@extends('layouts.master')

@section('title', '')

@section('header-style', 'promo--vsmall')

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="title uk-heading-hero">Find Artist</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')

    <section class="pr__about pr__section uk-section uk-section-large" id="pr__about">
        <div class="section-outer">
            <div class="section-heading uk-margin-remove-bottom">
                <div class="outer">
                    <div class="uk-container">
                        <section class="pr__services pr__section uk-section ">
                            <div class="section-outer">
                                <div class="section-heading uk-padding-remove-bottom uk-margin-remove-bottom">
                                    <div class="uk-container">
                                        <div class="inner uk-grid" uk-grid="">
                                            <div class="uk-width-1-4 uk-first-column">
                                                <hr class="line pr__hr__secondary">
                                                <h2 class="title uk-h1">Services.
                                                </h2>
                                                <span class="subtitle pr__heading__secondary">We work with you, We work for you</span>
                                            </div>

                                            <div class="uk-width-3-4">
                                                <div class="outerx">
                                                    <div class="uk-containerx">
                                                        <div class="search-box-wrap" style="max-width: 100%!important;">
                                                            <div class="">
                                                                @include('shared.search-form-main')
                                                            </div>

                                                        </div>
                                                    </div><!-- Container End -->
                                                </div><!-- Outer End -->
                                            </div><!-- Heading End -->

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section><!-- Section: Services End -->


                    </div><!-- Container End -->
                </div><!-- Outer End -->
            </div><!-- Heading End -->
            <div class="gallery-wrap-inset">
                <div class="gallery-grid" style="position: relative; height: 1389.89px;">
                    @foreach($data['artists'] as $artist)
                    <a href="{{ $artist->getArtistFrontendUrl() }}" class="grid-item grid-item--small"
                       style="position: absolute; left: 0%; top: 0px;">
                        <div class="item gallery-box small">
                            <div class="outer">
                                <div class="image pr__image__cover" style="padding-top: 0 !important;">
                                    <img width="1024" height="1024"
                                         src="{{ $artist->getImage() }}" alt="{{ $artist->full_name }}"
                                         class="attachment-large size-large wp-post-image" alt="" decoding="async"
                                         loading="lazy"></div>
                                <div class="inner">
                                    <h3 class="title uk-h5">{{ $artist->full_name }} </h3>
                                    <p class="description">Music artists/ pop artist</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{ $data['artists']->links('vendor.pagination.frontend-artist-listing') }}

        </div><!-- Outer End -->
    </section>
@endsection

@push('css')
    <style>
        .gallery-wrap-inset {
            margin-left: -10px;
            margin-right: -10px;
        }

        @media only screen and (min-width: 1281px) {
            .gallery-wrap-inset {
                max-width: 90%;
                margin: 0 auto;
            }
        }

        .grid-item {
            display: block;
            width: calc(33.33% - 20px);
            padding: 10px;
        }

        .grid-item--small {
            width: calc(25% - 20px);
            padding: 10px;
        }

        @media only screen and (max-width: 769px) {
            .grid-item {
                width: calc(50% - 10px);
                padding: 5px;
            }
        }

        .search-box h3 {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script
        src="{{ asset('dist/themes/artist-nepal/js/imagesloaded.pkgd.js') }}"></script>
    <script
        src="{{ asset('dist/themes/artist-nepal/js/masonry.pkgd.min.js') }}"></script>
    <script>
        var grid = document.querySelector('.gallery-grid');
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
    </script>
@endpush
