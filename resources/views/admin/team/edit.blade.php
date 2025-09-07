@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/seo.css') }}" rel="stylesheet">
    <style>
        .nav-tabs .nav-link.active {
            background-color: #ffffff!important;
        }
        .select2 {
            width: 100%!important;
        }
        .team-tr-manager {
            margin: 15px;
        }
    </style>
@endpush

@section('title', 'Edit Team')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Team</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.team.edit') }}">Team</a>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content">

        <div class="ibox">
            <form action="{{ route('admin.team.update') }}" id="team-form" enctype="multipart/form-data" method="POST">
                @csrf
                @include('admin.team.partials.form')

                <div class="hr-line-dashed"></div>

                <div class="form-group row">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    @include('admin.team.partials.scripts')
    <script src="{{ asset('dist/js/seo.js') }}"></script>
@endpush
