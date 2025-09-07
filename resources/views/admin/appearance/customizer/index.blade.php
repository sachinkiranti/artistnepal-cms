@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
@endpush

@section('title', 'Appearance')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Customizer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-6" style="padding-top: 30px;">

            <div class="btn-toolbar pull-right">
                <a href="" class="btn btn-primary"><i class="fa fa-save"></i> Save</a>
            </div>

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Component List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        <div class="table-responsive">

                            <table class="table table-striped table-bordered table-hover dataTables-list" >
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['components'] as $name => $component)

                                        @php $component = (object) $component; @endphp
                                        <tr>
                                            <td><b>{{ ucwords(str_replace([ '-', '_', ], ' ', $name)) }} <br> <code>{{ $name }}</code></b></td>
                                            <td>{{ ucfirst($component->type) }}</td>
                                            <td>@include('admin.common.status', [ 'data' => $component ])</td>
                                            <td>
                                                <a href="{{ route('admin.customizer.edit', $name) }}" class="btn btn-xs btn-primary" title="Edit Component"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No Components!</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var DataTableOptions = {
            serverSide: false,
            processing: false,
            defaultPagination: 10,
            export: {
                columns: [ 0, 1, ],
                title: 'Application : Customizer Print'
            },
            columns: [
                { data: 'name', orderable: true },
                { data: 'type', orderable: true },
                { data: 'status', orderable: true },
                { data: 'action', orderable: false },
            ],
            order: [[ 1, 'desc' ]],
            filters: function () {
                this.api().columns([2]).every(function () {
                    var column = this;
                    $('<input class="form-control">')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
                this.api().columns([3]).every(function () {
                    var column = this;
                    $('<input class="form-control">')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            },
        };
    </script>
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/list.js') }}"></script>
@endpush
