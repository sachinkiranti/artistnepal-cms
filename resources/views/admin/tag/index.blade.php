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

@section('title', 'Tag List')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'List',
        'panel'=> 'tag',
    ])
    <div class="wrapper wrapper-content animated fadeInRight">

        <summary title="Tag">
            @forelse($data['status'] as $key => $value)
                @include('admin.common.count',compact('key','value'))
            @empty
            @endforelse
        </summary>

        @component('admin.common.advanced-filter')
            @include('admin.tag.partials.advanced-filter-form')
        @endcomponent

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Tag List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.tag.partials.table')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).on('ready', function () {
            toastr.success('dasda');
        })
         DataTableOptions = {
            defaultPagination: 10,
            export: {
                columns: [ 1, 2, 3],
                title: 'Application : Tag Print'
            },
            ajax: {
                url: '{{ route('admin.tag.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}';
                    data.filter = {
                        title : $('input[name=filter_title]').val(),
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
                { data: 'checkbox', orderable: false, width: "5%" },
                { data: 'tag_name', orderable: true },
                { data: 'description' },
                { data: 'created_at', orderable: true },
                { data: 'status'},
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
            }
        };
    </script>

    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/list.js') }}"></script>
    <x-summaryscripts table="tags" />
@endpush
