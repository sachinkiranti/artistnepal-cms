@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a gallery')

@section('content')

    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'gallery',
        'id'=> $data['gallery']->id,
    ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['gallery'],['route' => ['admin.gallery.update',$data['gallery']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'galleryForm']) !!}
        {!! Form::hidden('id', $data['gallery']->id) !!}
        @includeIf('admin.gallery.partials.form')
        @includeIf('admin.common.action')
        {!! Form::close() !!}
    </div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    @include('admin.gallery.partials.scripts')
    <script src="{{ asset('dist/js/gallery-manager.js') }}"></script>
@endpush
