@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/seo.css') }}" rel="stylesheet">
    <style>
        .text-capitalize{
            text-transform: capitalize;
        }
        .tox .tox-dialog-wrap__backdrop {
            background-color:transparent !important;
        }
        .tox-dialog {
            width: 56%!important;
            max-width: 56%!important;
        }
        i.mce-i-icon-ads:before {
            content: "\f29e";
            font-family: FontAwesome;
        }
        .mce-window-head .mce-title {
            font-size: 11px!important;
        }
        .delete-gallery {
            margin: 5px;
        }
        .select2-container--default .select2-selection--single {
            border-radius: 0px;
        }
        .select2-container .select2-selection--single {
            height: 34px;
        }

        .select-wrapper {
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('title', 'Edit a Post')

@section('content')

    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'post',
        'id'=> $data['post']->id,
    ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['post'],['route' => ['admin.post.update',$data['post']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'postForm']) !!}
        {!! Form::hidden('id', $data['post']->id) !!}
        <div class="row">
            @includeIf('admin.post.partials.form')
        </div>

        @includeIf('admin.common.action')
        {!! Form::close() !!}
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    @include('admin.post.partials.scripts')
    <script src="{{ asset('dist/js/seo.js') }}"></script>
    <script src="{{ asset('dist/js/post-gallery-manager.js') }}"></script>
@endpush
