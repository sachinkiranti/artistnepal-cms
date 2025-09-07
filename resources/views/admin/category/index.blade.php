@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
    <style>
        .ibox-content-first{
            padding-top: 30px;
        }
    </style>
@endpush

@section('title', 'Category List')

@section('content')
    @include('admin.common.breadcrumbs', [
    'title'=> 'List',
        'panel'=> 'category',
    ])
    <div class="wrapper wrapper-content animated fadeInRight">

        <x-summary>
            @slot('title') Category @endslot
            @forelse($data['status'] as $key => $value)
                @include('admin.common.count',compact('key','value'))
            @empty
            @endforelse
        </x-summary>

        @component('admin.common.advanced-filter')
            @include('admin.category.partials.advanced-filter-form')
        @endcomponent

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Category List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.category.partials.table')
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
                columns: [ 1, 2, 3, 4, 5, ],
                title: 'Application : Category Print'
            },
            ajax: {
                url: '{{ route('admin.category.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}';
                    data.filter = {
                        identifier : $('input[name=filter_identifier]').val(),
                        name : $('input[name=filter_name]').val(),
                        description : $('input[name=filter_description]').val(),
                        status : $('select[name=filter_status]').val(),
                        createdAt: {
                            from: $('input[name=from]').val(),
                            to: $('input[name=to]').val(),
                        }
                    };
                }
            },
            columns: [
                {data: 'checkbox', orderable: false, width: "5%" },
                { data: 'category_name', orderable: true },
                { data: 'description', orderable: true },
                { data: 'created_at', orderable: true },
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
                this.api().columns([4]).every(function () {
                    var column = this;
                    $('<input class="form-control">')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
                this.api().columns([5]).every(function () {
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

    <x-summaryscripts table="categories" />
@endpush
