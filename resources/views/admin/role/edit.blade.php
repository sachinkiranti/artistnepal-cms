@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a Role')

@section('content')

    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'role',
        'id'=> $data['role']->id,
    ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['role'],['route' => ['admin.role.update',$data['role']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'roleForm']) !!}
        {!! Form::hidden('id', $data['role']->id) !!}
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content role_assign">
                        @includeIf('admin.role.partials.form')
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
