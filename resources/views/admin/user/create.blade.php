@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Create a User')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Create',
        'panel'=> 'user',
    ])

    <div class="wrapper wrapper-content">
        {!! Form::open(['route' => 'admin.user.store', 'enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'userForm']) !!}
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Information</h5>
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
