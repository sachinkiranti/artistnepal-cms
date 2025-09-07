@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
@endpush

@section('title', 'Category List')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'List',
        'panel'=> 'category',
    ])
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="col-lg-12 row">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border ibox-title-border-custom ">
                        <span class="label label-success float-right"><a href="{{ route('admin.tag.index') }}" style="color: white;">View All</a></span>
                        <h5>Tag</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom custom-count-container">
                        <span class="text-success float-right count-value"> {{ $data['tagCount'] }} </span>
                        <h1 class="no-margins">Total</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border ibox-title-border-custom ">
                        <span class="label label-success float-right"><a href="{{ route('admin.category.index') }}" style="color: white;">View All</a></span>
                        <h5>Category</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom custom-count-container">
                        <span class="text-success float-right count-value"> {{ $data['categoryCount'] }} </span>
                        <h1 class="no-margins">Total</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border ibox-title-border-custom ">
                        <h5>List of Tag Use</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content ibox-content-custom custom-count-container">
                        @forelse($data['modelByTagList'] as $tag)
                            <li style="list-style: none;"> <span>{{ $tag->tagName }}</span></li>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

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
                columns: [ 1, 2, 3, 4 ],
                title: 'Application : category Print'
            },
            ajax: {
                url: '{{ route('admin.category.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'checkbox', orderable: false },
                { data: 'category_name', orderable: true },
                { data: 'description', orderable: true },
                { data: 'status', orderable: true },
                { data: 'created_at', orderable: true },
                { data: 'action', orderable: false },
            ],
            order: [[ 0, 'desc' ]],
            filters: function () {
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
