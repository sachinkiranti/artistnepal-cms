@extends('admin.layouts.master')

@push('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Create a Category')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Create',
        'panel'=> 'category',
    ])

    <div class="wrapper wrapper-content">
        {!! Form::open(['route' => 'admin.category.store', 'enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'categoryForm']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @include('admin.category.partials.form')
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
    @include('admin.category.partials.scripts')
@endpush
