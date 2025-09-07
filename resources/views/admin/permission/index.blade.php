@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
@endpush

@section('title', 'Permission List')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'List',
        'panel'=> 'permission',
    ])
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>permission List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.permission.partials.table')

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
                title: 'Application : permission Print'
            },
            ajax: {
                url: '{{ route('admin.permission.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'name' },
                { data: 'slug', orderable: true },
                { data: 'description', orderable: false },
                { data: 'created_at', orderable: true },
                { data: 'status', orderable: true },
                { data: 'action', orderable: false },
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
            }
        };
    </script>
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/list.js') }}"></script>
@endpush
