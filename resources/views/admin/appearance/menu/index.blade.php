@extends('admin.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('dist/css/menu-builder.css') }}">
@endpush

@section('title', 'Appearance')

@section('content')
    <div class="menu-manager">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h2>Menu</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard.index') }}">Home</a>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-sm-4">
                    <div class="accordion" id="accordionExample">
                        @include('admin.appearance.menu.partials.menu-posts', [
                            'data' => $data['posts'],
                        ])
                        @include('admin.appearance.menu.partials.menu-pages', [
                            'data' => $data['pages'],
                        ])
                        @include('admin.appearance.menu.partials.menu-custom-links', [
                            'data' => $data['targets'],
                        ])
                        @include('admin.appearance.menu.partials.menu-categories', [
                            'data' => $data['categories'],
                        ])
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="ibox">
                        {!! Form::open(['route' => 'admin.save.menu', 'enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'MenuForm']) !!}

                        <div class="ibox-title">
                            <h5>Menu</h5>

                            <p class="pull-right">
                                {!! Form::select('section', $data['menu-sections'], null, ['class' => 'form-control menu-section-selector', 'placeholder' => 'Select the menu section', ]) !!}
                            </p>
                        </div>
                        <div class="ibox-content">
                            <div class="hr-line-dashed"></div>
                            <p>Drag each item into the order you prefer. Click the setting on the right of the item to reveal additional configuration options.</p>
                            <div class="hr-line-dashed"></div>

                            <div class="menu-list-wrapper">
                                @include('admin.appearance.menu.partials.list')
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h5><i class="fa fa-cog"></i> Setting</h5>
                            <div class="hr-line-dashed"></div>

                            <button type="submit" class="btn btn-primary save-menu-list"><i class="fa fa-save"></i> Save</button>
                            <br>
                            <div class="hr-line-dashed"></div>

                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>

        @include('admin.appearance.menu.partials.modal', [ 'data' => $data['targets'], ])
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/menu-builder.js') }}"></script>
@endpush
