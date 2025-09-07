@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Create a gallery')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Create',
        'panel'=> 'gallery',
    ])

    <div class="wrapper wrapper-content">
        {!! Form::open(['route' => 'admin.gallery.store', 'enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'galleryForm']) !!}
        @include('admin.gallery.partials.form')
        @includeIf('admin.common.action')
        {!! Form::close() !!}
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    @include('admin.gallery.partials.scripts')
    <script src="{{ asset('dist/js/gallery-manager.js') }}"></script>
@endpush
