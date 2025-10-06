@extends('layouts.master')

@section('title', '')

@section('promo-banner', $data['page']->getBanner())

@section('promo-container')
    <hr class="line pr__hr__secondary">
    <h2 class="page-title  uk-heading-primary" style="color: white;">{{ $data['page']->title }}</h2>
@endsection

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@section('content')
    <div class="pr__primary uk-section uk-section-medium" id="site-primary">
        <div class="outer">
            <div class="uk-container uk-position-relative">
                <div class="inner uk-grid uk-grid-large uk-grid-match uk-grid-stack" data-uk-grid="">
                    <div class="uk-width-expand uk-first-column">
                        <main class="pr__main" id="site-main">
                            <article class="uk-article post type-post single-post">
                                <div class="outer uk-grid uk-grid-large uk-flex uk-grid-stack" data-uk-grid="">
                                    <div class="inner uk-width-expand uk-first-column">
                                        <div class="entry-body">
                                            {!! $data['page']->content !!}

                                            <p style="text-align: right;"><span style="color: #808080;"><em>updated on: {{ $data['page']->updated_at->format('d/m/Y') }}</em></span></p>
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

@endsection

@push('css')

@endpush

@push('js')

@endpush
