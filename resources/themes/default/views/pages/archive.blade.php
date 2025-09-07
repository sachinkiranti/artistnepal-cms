@extends('layouts.master')

@section('title', $data['category_title'])

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">

    @include('pages.shared.metas', [
        'title'         => $data['category'] ?? $data['category_title'],
        'description'   => $data['category'] ?? $data['category_title'],
        'image_url'     => asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('social_homepage_image')),
    ])
@endpush

@push('styles')
    <style>
        .pagination {
            display: inline-block;
            list-style: none;
        }

        ul.pagination li {display: inline;}

        .pagination li a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination li a.active {
            background-color: #4CAF50;
            color: white;
        }

        .pagination li a:hover:not(.active) {background-color: #ddd;}
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="category-list">
            <div class="row">
                <div class="col-9">
                    <div class="title bg-purple"><h4>{{ ucwords(str_replace(['-', '_'], ' ', $data['category'] ?? $data['category_title'])) }} </h4></div>

                    @include('pages.shared.archive.posts')

                    {{ $data['posts']->links() }}

{{--                    @if ($data['posts']->isNotEmpty())--}}
{{--                        @if (isset($data['posts_count']) && $data['posts_count'] > $data['posts']->count())--}}
{{--                            <div class="more-button">--}}
{{--                                <a href="javascript:void(0)" title="{{ __('थप समाचार') }}" class="more-news load-more-news"--}}
{{--                                   data-category="{{ $data['category_id'] ?? $data['category_title'] }}"--}}
{{--                                   data-count="{{ $data['posts_count'] }}">--}}
{{--                                    <img src="{{ asset('images/arrow-down.png') }}"> {{ __('थप समाचार') }} </a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endif--}}
                </div>
                <div class="col-3">

                    {!! $components['page-sidebar-component'] ?? '' !!}

                </div>
            </div>
        </div>
        <!-- /category list -->
    </div>
@endsection

@push('scripts')
    <script src="{{ theme_asset('js/archive.min.js') }}"></script>
@endpush
