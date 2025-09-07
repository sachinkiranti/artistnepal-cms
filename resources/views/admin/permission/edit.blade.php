@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a Permission')

@section('content')

    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'permission',
        'id'=> $data['permission']->id,
    ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['permission'],['route' => ['admin.permission.update',$data['permission']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'permissionForm']) !!}
        {!! Form::hidden('id', $data['permission']->id) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.permission.partials.form')
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
    @include('admin.permission.partials.scripts')
@endpush
