@extends('layouts.master')

@section('title', '')

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="title uk-heading-hero">Know about your favorite artist with ArtistNepal!</h2>
    <a class="button uk-button uk-button-large uk-button-default uk-margin-top"
       href="#pr__artist_search" data-uk-scroll="">Find Artist</a>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')
    @include('pages.partials.index.banner-caption')

    @include('shared.search-form')

    @include('pages.partials.index.gallery')

    <hr class="pr__vr__section">

    @include('shared.artist-categories')

    <hr class="pr__vr__section">

    @include('shared.blog-slider')

    <hr class="pr__vr__section">

    @include('shared.info-1')
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
