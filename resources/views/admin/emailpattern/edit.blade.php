@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Edit a Email Pattern')

@section('content')

    @include('admin.common.breadcrumbs', [
        'title'=> 'Edit',
        'panel'=> 'emailpattern',
        'id'=> $data['emailpattern']->id,
    ])

    <div class="wrapper wrapper-content">
        {!! Form::model($data['emailpattern'],['route' => ['admin.emailpattern.update',$data['emailpattern']->id], 'enctype' => 'multipart/form-data', 'method' => 'put', 'id' => 'emailpatternForm']) !!}
        {!! Form::hidden('id', $data['emailpattern']->id) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.emailpattern.partials.form')
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
    @include('admin.emailpattern.partials.scripts')
@endpush
