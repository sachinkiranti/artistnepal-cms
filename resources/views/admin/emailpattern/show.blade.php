@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Email Pattern')

@section('content')

@include('admin.common.breadcrumbs', [
'title' => 'Show',
'panel' => 'emailpattern',
'id'    => $data['emailpattern']->id,
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
    <td style="width:35%;">Name</td>
    <td style="width:65%">{{ $data['emailpattern']->name }}</td>
</tr>
<tr>
    <td style="width:35%;">Slug</td>
    <td style="width:65%">{{ $data['emailpattern']->slug }}</td>
</tr>
<tr>
    <td style="width:35%;">Status</td>
    <td style="width:65%">{{ $data['emailpattern']->status }}</td>
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

@endpush
