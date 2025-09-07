@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
@endpush

@section('title', 'Dashboard')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ibox-wrapper-custom">
                    <div class="ibox-title ibox-card-custom pr-2">
                        <span class="label label-success float-right">All</span>
                        <h4 class="d-inline"> <i class="fa fa-user-circle"></i> User</h4>
                    </div>
                    <div class="ibox-content ibox-card-custom-container">
                        <span class="text-success float-right count-value" id="summary-"> {{ $data['user'] }} </span>
                        <p class="no-margins" id="summary--name" style="text-transform: capitalize">Total</p>
                        <div class="ibox-content"></div>
                    </div>
                </div>
            </div>

            @foreach (\App\Foundation\Enums\Role::getStats() as $role)
                <div class="col-lg-2">
                    <div class="ibox ibox-wrapper-custom">
                        <div class="ibox-title ibox-card-custom pr-2">
                            <span class="label label-success float-right">All</span>
                            <h4 class="d-inline"> <i class="fa fa-user-circle"></i> {{ ucwords($role) }}</h4>
                        </div>
                        <div class="ibox-content ibox-card-custom-container">
                            <span class="text-success float-right count-value" id="summary-"> {{ $data[$role] }} </span>
                            <p class="no-margins" id="summary--name" style="text-transform: capitalize">Total</p>
                            <div class="ibox-content"></div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-lg-2">
                <div class="ibox ibox-wrapper-custom">
                    <div class="ibox-title ibox-card-custom pr-2">
                        <span class="label label-success float-right">All</span>
                        <h4 class="d-inline"> <i class="fa fa-newspaper-o"></i> Post</h4>
                    </div>
                    <div class="ibox-content ibox-card-custom-container">
                        <span class="text-success float-right count-value" id="summary-"> {{ $data['post'] }} </span>
                        <p class="no-margins" id="summary--name" style="text-transform: capitalize">Total</p>
                        <div class="ibox-content"></div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->hasAccess())
                <div class="col-lg-2">
                    <div class="ibox ibox-wrapper-custom">
                        <div class="ibox-title ibox-card-custom pr-2">
                            <span class="label label-success float-right">All</span>
                            <h4 class="d-inline"> <i class="fa fa-th-list"></i> Category</h4>
                        </div>
                        <div class="ibox-content ibox-card-custom-container">
                            <span class="text-success float-right count-value" id="summary-"> {{ $data['category'] }} </span>
                            <p class="no-margins" id="summary--name" style="text-transform: capitalize">Total</p>
                            <div class="ibox-content"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
