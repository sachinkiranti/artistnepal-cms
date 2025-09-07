@extends('layouts.master')

@section('title', 'सत्य, तथ्य अनि निर्भिकताको अर्को नाम-हिमालय खबर')

@push('metas')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="asset-path" content="{{ theme_asset() }}">
@endpush

@push('styles')
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

@section('content')
    @include('admin.appearance.customizer.widgets.partials.edit-model')
    @foreach ($wrappers as $wrapper)
        @php
            $advertisement = \Illuminate\Support\Arr::get($advertisements, $wrapper);
            if ($advertisement) {
                $topAds = Arr::get(array_values($advertisement), '0.top');
                $bottomAds = Arr::get(array_values($advertisement), '1.bottom');
            }
        @endphp

        @if (isset($topAds) && ! empty($topAds) && isset($topAds['image']))
            @foreach($topAds['image'] as $index => $value)
                @if(!is_null(Arr::get($topAds, 'image.'.$index)))
                    <div class="adv adv-full ad-wrapper" style="margin-top: 15px;" data-index="0" data-type="top" data-widget="breaking-news">
                        <a href="{{ Arr::get($topAds, 'caption.'.$index) }}" title="{{ Arr::get($topAds, 'caption.'.$index) }}" target="_blank">
                            <img src="{{ Arr::get($topAds, 'image.'.$index) }}" alt="adv-{{ Arr::get($topAds, 'caption.'.$index) }}">
                        </a>
                    </div>
                @endif
            @endforeach
        @endif

        @include('pages.shared.home.'.$wrapper)

        @if (isset($bottomAds) && ! empty($bottomAds) && isset($bottomAds['image']))
            @foreach($bottomAds['image'] as $index => $value)
                @if(!is_null(Arr::get($bottomAds, 'image.'.$index)))
                    <div class="adv adv-full ad-wrapper" style="margin-top: 15px;" data-index="0" data-type="top" data-widget="breaking-news">
                        <a href="{{ Arr::get($bottomAds, 'caption.'.$index) }}" title="{{ Arr::get($bottomAds, 'caption.'.$index) }}" target="_blank">
                            <img src="{{ Arr::get($bottomAds, 'image.'.$index) }}" alt="adv-{{ Arr::get($bottomAds, 'caption.'.$index) }}">
                        </a>
                    </div>
                @endif
            @endforeach
        @endif

    @endforeach
@endsection

@push('scripts')
    <script src="{{ theme_asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ theme_asset('js/customizer.min.js') }}"></script>
@endpush
