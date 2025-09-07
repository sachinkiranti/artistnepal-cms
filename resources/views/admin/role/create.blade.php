@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Create a Role')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Create',
        'panel'=> 'role',
    ])

    <div class="wrapper wrapper-content">
        {!! Form::open(['route' => 'admin.role.store', 'enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'roleForm']) !!}
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @include('admin.role.partials.form')

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Choose Permissions</h5>
                    </div>
                    <div class="ibox-content pb-3 permission-wrapper">
                        @includeIf('admin.role.partials.permission-assign')
                    </div>
                </div>
            </div>
        </div>
        @includeIf('admin.common.action')
        {!! Form::close() !!}
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    @include('admin.role.partials.scripts')
@endpush
