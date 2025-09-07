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

@section('title', 'gallery')

@section('content')

@include('admin.common.breadcrumbs', [
'title' => 'Show',
'panel' => 'gallery',
'id'    => $data['gallery']->id,
])

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">

                <div class="ibox-content">
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
                            <td style="width:65%">{{ $data['gallery']->name }}</td>
                        </tr>

                        <tr>
                            <td style="width:35%;">Total Image</td>
                            <td style="width:65%">{{ $data['gallery-images'] }}</td>
                        </tr>

                        <tr>
                            <td style="width:35%;">Image</td>
                            <td style="width:65%">
                                <img style="max-height: 200px;" src="{{ asset('storage/images/gallery/'.$data['gallery']->thumbnail) }}" alt="">
                            </td>
                        </tr>

                        <tr>
                            <td style="width:35%;">Content</td>
                            <td style="width:65%">{{ $data['gallery']->content }}</td>
                        </tr>

                        <tr>
                            <td style="width:35%;">Description</td>
                            <td style="width:65%">{{ $data['gallery']->description }}</td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Status</td>
                            <td style="width:65%" >
                                @include('admin.common.show-status' , [
                                        'model' => 'gallery',
                                    ])
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/show.js') }}"></script>
@endpush
