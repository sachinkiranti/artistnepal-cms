@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a Category')

@section('content')

    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'category',
        'id'=> $data['category']->id,
    ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['category'],['route' => ['admin.category.update',$data['category']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'categoryForm']) !!}
        {!! Form::hidden('id', $data['category']->id) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.category.partials.form')
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
