@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
@endpush

@section('title', 'User List')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'List',
        'panel'=> 'user',
    ])
    <div class="wrapper wrapper-content animated fadeInRight">
        @component('admin.common.advanced-filter')
            @include('admin.user.partials.advanced-filter-form')
        @endcomponent

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>User List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.user.partials.table')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        DataTableOptions = {
            defaultPagination: 10,
            export: {
                columns: [ 0, 1, 2, 3, 4, ],
                title: 'Application : User Data Print'
            },
            ajax: {
                url: '{{ route('admin.user.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}'
                    data.filter = {
                        name: $('input[name=name]').val(),
                        role: $('select[name=role]').val(),
                        creation: {
                            start: $('input[name=creation_start]').val(),
                            end: $('input[name=creation_end]').val(),
                        },
                        soft_delete: $('select[name=softdelete]').val(),
                    }
                }
            },
            columns: [
                {data: 'checkbox', orderable: false, width: "5%" },
                { data: 'full_name', orderable: true },
                { data: 'roles', orderable: true },
                { data: 'email', orderable: true },
                { data: 'created_at', orderable: true },
                { data: 'action', orderable: false },
            ],
            order: [[ 1, 'desc' ]],
            filters: function () {
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
                this.api().columns([4]).every(function () {
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
