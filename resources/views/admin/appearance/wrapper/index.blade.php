@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('dist/css/component-wrapper-builder.css') }}">
    <style>
        .wrapper-advertisement img { width: 25%; }
        .advertisement-row .input-group { width: 50%; }
    </style>
@endpush

@section('title', 'Component Wrapper List')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Component Wrapper Management</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Component Wrapper List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        <div class="col-sm-12">
                            <div class="ibox">
                                {!! Form::open(['route' => 'admin.wrapper.save', 'method' => 'POST', 'id' => 'WrapperForm']) !!}
                                <div class="hr-line-dashed"></div>

                                <div class="wrapper-list-wrapper advertisement-manager">
                                    <ul class="sorter ui-sortable sortable-wrapper-list">
                                        <li class="ui-sortable-handle sortable-wrapper-list-li text-center">
                                            <ul class="sorter ui-sortable">
                                                @isset($data['wrappers'])
                                                    @foreach($data['wrappers'] as $wrapper)
                                                        <li class="ui-sortable-handle">

                                                            <input type="hidden" name="wrappers[]" value="{{ $wrapper }}">
                                                            <span style="margin-right: 15px;font-weight: bold;margin-top: 4px;">
                                                                <i class="fa fa-adjust"></i> {{ ucwords(str_replace(['-', '_'], ' ', $wrapper)) }}
                                                            </span>

                                                            @php
                                                                $advertisement = \Illuminate\Support\Arr::get($data['advertisements'], $wrapper);
                                                                $topAds = Arr::get(array_values($advertisement), '0.top');
                                                                $bottomAds = Arr::get(array_values($advertisement), '1.bottom');
                                                            @endphp

                                                            <table class="table" style="background: #f4f4f4;margin-bottom: 0;border: 1px solid #ccc;">
                                                                <tr>
                                                                    <th colspan="3"><h5>Top Advertisement</h5></th>
                                                                </tr>
                                                                <tr>
                                                                    <th style="width: 50%;">Ad Image</th>
                                                                    <th>Url</th>
                                                                    <th>
                                                                        <a href="#" class="btn btn-xs btn-primary add-advertisement">
                                                                            <i class="fa fa-plus"></i>
                                                                        </a>
                                                                    </th>
                                                                </tr>

                                                                @if (isset($topAds) && ! empty($topAds) && isset($topAds['image']))

                                                                    @foreach($topAds['image'] as $index => $value)
                                                                        @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                                                                            'widgetId' => $wrapper ?? '',
                                                                            'image'    => Arr::get($topAds, 'image.'.$index),
                                                                            'caption'  => Arr::get($topAds, 'caption.'.$index),
                                                                            'position' => 'top',
                                                                        ])
                                                                    @endforeach

                                                                @else

                                                                    @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                                                                        'widgetId' => $wrapper ?? '',
                                                                        'position' => 'top',
                                                                    ])

                                                                @endif

                                                            </table>

                                                            <span>
                                                                <img src="{{ theme_asset('img/wrappers/'.$wrapper.'.png') }}" style="max-height: 200px;" alt="{{ $wrapper }}">
                                                            </span>

                                                            <table class="table" style="background: #f4f4f4;margin-bottom: 0;border: 1px solid #ccc;">
                                                                <tr>
                                                                    <th colspan="3">
                                                                        <h5>Bottom Advertisement</h5>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th>Ad Image</th>
                                                                    <th>Url</th>
                                                                    <th>
                                                                        <a href="#" class="btn btn-xs btn-primary add-advertisement"><i class="fa fa-plus"></i></a>
                                                                    </th>
                                                                </tr>

                                                                @if (isset($bottomAds) && ! empty($bottomAds)  && isset($bottomAds['image']))

                                                                    @foreach($bottomAds['image'] as $index => $value)

                                                                        @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                                                                            'widgetId' => $wrapper ?? '',
                                                                            'image'    => Arr::get($bottomAds, 'image.'.$index),
                                                                            'caption'  => Arr::get($bottomAds, 'caption.'.$index),
                                                                            'position' => 'bottom',
                                                                        ])

                                                                    @endforeach

                                                                @else

                                                                    @include('admin.appearance.customizer.widgets.partials.advertisement-row', [
                                                                        'widgetId' => $wrapper ?? '',
                                                                        'position' => 'bottom',
                                                                    ])

                                                                @endif
                                                            </table>
                                                        </li>
                                                    @endforeach
                                                @endisset
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                                @includeIf('admin.common.action')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('dist/js/component-wrapper-builder.js') }}"></script>
    <script>
        $(function () {
            var AdvertisementManager = {
                init: function () {
                    this.cacheDom();
                    this.bind();
                },

                cacheDom: function () {
                    this.$advertisementManager = $('.advertisement-manager');
                },

                bind: function () {
                    $(document).on('click', '#lfm', this.showFileManager);

                    this.$advertisementManager.on('click', '.add-advertisement', this.addNewAdvertisementTr);
                    this.$advertisementManager.on('click', '.delete-advertisement', this.removeAdvertisement);
                },

                removeAdvertisement: function () {
                    var $this, countOfRow;
                    $this = $(this);
                    countOfRow = $this.parents('table').find('tbody tr.advertisement-row').length;

                    if (countOfRow > 1) {
                        $this.closest('tr').remove();
                    }
                    return false;
                },

                addNewAdvertisementTr: function () {
                    var $this, $row, $clone, random, thumbnail, holder;
                    $this = $(this);
                    $row = $this.parents('table').find('tbody tr.advertisement-row:first');
                    $clone = $row.clone();
                    $clone.find(':input').val('');
                    $clone.find('img').attr('src', '');
                    random = Math.floor((Math.random() * 100000) + 1);
                    thumbnail = 'thumbnail'+random;
                    holder    = 'holder'+random;
                    $clone.find('td > .input-group :input').attr('id', thumbnail);
                    $clone.find('td > .input-group a').attr('data-input', thumbnail);
                    $clone.find('td > .input-group a').attr('data-preview', holder);
                    $clone.find('td > .input-group').next().attr('id', holder);

                    $row.after($clone);
                    return false;
                },

                showFileManager: function () {
                    $(this).filemanager('image');
                },
            };

            AdvertisementManager.init();
        });

    </script>
@endpush
