@extends('admin.layouts.master')

@push('css')
    <style>
        .ibox-content-custom {
            padding: 25px 20px 15px 20px;
        }
        .change-status{
            cursor: pointer;
        }
    </style>
@endpush

@section('title', 'User')

@section('content')

@include('admin.common.breadcrumbs', [
    'title' => 'Show',
    'panel' => 'user',
    'id'    => $data['user']->id,
])

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-4">
            <div class="ibox-content text-center pt-5">
                <img alt="image" class="img-fluid col-md-8" src="{{ $data['user']->getImage() }}">
                <div class="user-info mt-4">
                    <h4><strong>{{ $data['user']->first_name }} {{ $data['user']->middle_name }} {{ $data['user']->last_name }}</strong></h4>
                    <p><i class="fa fa-envelope-o"></i> {{ $data['user']->email }}</p>
                    <div class="hr-line-dashed"></div>
                    @if ($data['user']->information)
                        <p>{{ $data['user']->information }}</p>
                        <div class="hr-line-dashed"></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-content ibox-content-custom">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="150px">Label</th>
                            <th>Information</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width:35%;">Name</td>
                            <td style="width:65%">{{ $data['user']->first_name }} {{ $data['user']->middle_name }} {{ $data['user']->last_name }}</td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Status</td>
                            <td style="width:65%" >
                            @include('admin.common.show-status', [
                                'model' => 'user'
                            ])
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    @include('admin.common.action.delete' , ['route' => 'admin.user.destroy', 'id' => $data['user']->id, ])
                </div>
            </div>
        </div>

        @include('admin.user.partials.posts')

    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/show.js') }}"></script>
@endpush
