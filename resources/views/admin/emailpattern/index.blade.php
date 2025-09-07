@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
@endpush

@section('title', 'Email Pattern List')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Email Patterns Management</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.email-pattern.index') }}">Email Pattern</a>
                </li>

                <li class="breadcrumb-item">
                    <strong>Index</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Email Pattern List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.emailpattern.partials.table')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var DataTableOptions = {
            defaultPagination: 10,
            export: {
                columns: [ 0, 1, 2, 3 ],
                title: 'Application : emailpattern Print'
            },
            ajax: {
                url: '{{ route('admin.email-pattern.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'name' },
                { data: 'slug', orderable: true },
                { data: 'status', orderable: true },
                { data: 'created_at', orderable: true },
                /*{ data: 'action', orderable: false },*/
            ],
            order: [[ 0, 'desc' ]],
            filters: function () {
                this.api().columns([0]).every(function () {
                    var column = this;
                    $('<input class="form-control">')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
                this.api().columns([1]).every(function () {
                    var column = this;
                    $('<input class="form-control">')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        };
    </script>
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/list.js') }}"></script>
@endpush
