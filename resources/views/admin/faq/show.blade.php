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


@section('title', 'Faq')

@section('content')

@include('admin.common.breadcrumbs', [
'title' => 'Show',
'panel' => 'faq',
'id'    => $data['faq']->id,
])

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
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
                            <td style="width:35%;">Faq Name</td>
                            <td style="width:65%">{{ $data['faq']->faq_name }}</td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Body</td>
                            <td style="width:65%">{!! $data['faq']->body !!} </td>

                        </tr>
                        <tr>
                            <td style="width:35%;">Status</td>
                            <td style="width:65%" >
                            @include('admin.common.show-status' , [
                                    'model' => 'faq',
                                ])
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    @include('admin.common.action.delete' , ['route' => 'admin.faq.destroy', 'id' => $data['faq']->id, ])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/show.js') }}"></script>
@endpush
