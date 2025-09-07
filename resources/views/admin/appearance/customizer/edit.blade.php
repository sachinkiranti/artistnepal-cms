@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">

    <style>
        .widget-box {
            cursor: pointer;
        }

        .widget-droppable {
            min-height: 500px;
        }

        .widget-droppable-area .col-form-label { font-weight: 700; }
        .widget-droppable-area .required { color: red; }

        #edit-model .hr-line-dashed {
            border-top: 0;
            color: #f8fafb;
            background-color: #f8fafb;
            height: 0;
            margin: 0;
        }
    </style>
@endpush

@section('title', 'Appearance')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Customizer - <small style="cursor: pointer;" title="{{ $data['component'] }}">{{ ucwords(str_replace(['-', '-',], ' ', $data['component'])) }}</small></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-6" style="padding-top: 30px;">

            <div class="btn-toolbar pull-right">
                <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#edit-model"><i class="fa fa-save"></i> Save</a>
            </div>

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Widget</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="hr-line-dashed"></div>
                        @forelse($data['widgets'] as $key => $widget)
                            <div class="{{ $key }} widget-box widget-draggable" data-widget="{{ $key }}">
                                <div class="{{ $key }}-wrapper">
                                    <b>{{ ucwords(str_replace([ '-', '_', ], ' ', $key)) }}</b> <br>
                                    <b><small>{{ $widget['description'] }}</small></b>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            @empty
                            <p><b>No Widgets!</b></p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox widget-droppable-area">
                    <div class="ibox-title ibox-title-border">
                        <h5>Widget List <small>{{ ucwords(str_replace(['-', '-',], ' ', $data['component'])) }}</small></h5>
                    </div>
                    <div class="ibox-content component-widgets-wrapper">

                        <div class="widget-droppable" data-component="{{ $data['component'] }}">

                            @isset($data['component-widgets'])
                                @foreach($data['component-widgets'] as $key => $widget)
                                    @include('admin.appearance.customizer.widgets.partials.widget-list')
                                @endforeach
                            @endisset

                        </div>
                        <div class="hr-line-dashed"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.appearance.customizer.widgets.partials.edit-model')
    <div id="overlay-wrapper"></div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('dist/js/widget-manager.js') }}"></script>
@endpush
