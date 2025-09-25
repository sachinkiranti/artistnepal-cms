@extends('layouts.master')

@section('title', 'Setting')

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
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                Setting
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .pr__footer .pr__footer__bottom .section-inner .pr__links * + a {
            margin-left: .5rem;
            text-decoration: none;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>

    </script>
@endpush
