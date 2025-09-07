@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a User')

@section('content')

    @include('admin.user-type.partials.breadcrumb', [ 'title' => 'Edit', 'id' => $data['user']->id, ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['user'],[ 'route' => [ 'admin.user-type.update', $role->id, $data['user']->id, ],
            'enctype' => 'multipart/form-data', 'method' => 'patch']) !!}
        {!! Form::hidden('id', $data['user']->id) !!}
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.user.partials.form')
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @includeIf('admin.user.partials.extra-info')
            </div>
        </div>
        @includeIf('admin.common.action')
        {!! Form::close() !!}
    </div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    @includeIf('admin.user.partials.scripts')
@endpush
