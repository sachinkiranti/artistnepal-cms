@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a Email Template')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Email Template Management</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.email-template.index') }}">Email Template</a>
                </li>

                <li class="breadcrumb-item">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        {!! Form::model($data['emailtemplate'],['route' => ['admin.email-template.update',$data['emailtemplate']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'emailtemplateForm']) !!}
        {!! Form::hidden('id', $data['emailtemplate']->id) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.emailtemplate.partials.form')
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
    @include('admin.emailtemplate.partials.scripts')
@endpush
