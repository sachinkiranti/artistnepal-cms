@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Create a Faq')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Create',
        'panel'=> 'faq',
    ])

    <div class="wrapper wrapper-content">
        {!! Form::open(['route' => 'admin.faq.store', 'enctype' => 'multipart/form-data', 'method' => 'post','id'=>'faqFrom']) !!}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>General Info</h5>
                    </div>
                    <div class="ibox-content">
                        @includeIf('admin.faq.partials.form')
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
    @include('admin.faq.partials.scripts')
@endpush
