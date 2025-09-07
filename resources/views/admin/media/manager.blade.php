@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Dashboard')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row col-lg-12">

            <iframe src="/media?type=image" style="width: 100%; height: 600px; overflow: hidden; border: none;"></iframe>

        </div>
    </div>
@endsection
