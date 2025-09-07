@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
    <style>
        .ibox-content-first{
            padding-top: 30px;
        }
        .select2-container--default { width: 100%!important; }
    </style>
@endpush

@section('title', 'Post List')

@section('content')

    <x-breadcrumb title="List" panel="post" />


    <div class="wrapper wrapper-content animated fadeInRight">

        <x-summary>
            @slot('title') Post @endslot
            @forelse($data['status'] as $key => $value)
                @include('admin.common.count', compact('key','value'))
            @empty
            @endforelse
        </x-summary>

        <x-filter>
            @include('admin.post.partials.advanced-filter-form')
        </x-filter>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Post List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.post.partials.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var DataTableOptions = {
            defaultPagination: 25,
            export: {
                columns: [ 1, 2, 3, 4, 5 ],
                title: 'Application : Post Print'
            },
            ajax: {
                url: '{{ route('admin.post.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}';
                    data.filter = {
                        categories: $("select[name='filter_categories[]']").val(),
                        identifier : $('input[name=filter_identifier]').val(),
                        title : $('input[name=filter_title]').val(),
                        content : $('input[name=filter_content]').val(),
                        status : $('select[name=filter_status]').val(),
                        createdAt: {
                            from: $('input[name=from]').val(),
                            to: $('input[name=to]').val(),
                        },
                        CreatedBy : $('input[name=filter_created_by]').val(),
                        type : $('select[name=filter_news_type]').val(),
                    };
                }
            },
            columns: [
                { data: 'checkbox', orderable: false, width: "5%" },
                { data: 'category_name', orderable: false },
                { data: 'title', orderable: true },
                { data: 'created_by', orderable: true },
                { data: 'created_at', orderable: false },
                { data: 'status', orderable: true },
                { data: 'action', orderable: false },
            ],
            order: [[ 2, 'desc' ]],
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
    <x-summaryscripts table="posts" />

    <script>
        $(function () {
            $('.category-select-multiple').select2()
        })
    </script>
@endpush
