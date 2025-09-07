@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a Tag')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'tag',
        'id'   => $data['tag']->id,
    ])
    <div class="wrapper wrapper-content">
        {!! Form::model($data['tag'],['route' => ['admin.tag.update',$data['tag']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id'=>'tagForm']) !!}
        {!! Form::hidden('id', $data['tag']->id) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.tag.partials.form')
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
    @include('admin.tag.partials.scripts')
@endpush
