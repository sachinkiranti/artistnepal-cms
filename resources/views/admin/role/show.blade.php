@extends('admin.layouts.master')

@push('css')
    <style>
        .ibox-content-custom {
            padding: 25px 20px 15px 20px;
        }
    </style>
@endpush


@section('title', 'Role')

@section('content')

@include('admin.common.breadcrumbs', [
'title' => 'Show',
'panel' => 'role',
'id'    => $data['role']->id,
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
                                <td style="width:65%">{{ $data['role']->name }}</td>
                            </tr>
                            <tr>
                                <td style="width:35%;">Slug</td>
                                <td style="width:65%">{{ $data['role']->slug }}</td>
                            </tr>
                            <tr>
                                <td style="width:35%;">Description</td>
                                <td style="width:65%">{{ $data['role']->description }}</td>
                            </tr>
                            <tr>
                                <td style="width:35%;">Status</td>
                                <td style="width:65%"><span class="label label-{{ $data['role'] ? 'primary' : 'danger' }}" > {{ $data['role']->status ? 'Active' : 'Inactive' }} </span></td>
                            </tr>
                            <tr>
                                <td style="width:35%;">Permissions</td>
                                <td style="width:65%">
                                    @forelse($data['role_permissions'] as $permission)
                                        <code>{{ $permission['name'] }} </code> |
                                    @empty
                                        <b>No Permissions assigned</b>
                                    @endforelse
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

@endpush
