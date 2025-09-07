@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
@endpush

@section('title', 'Gallery List')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'List',
        'panel'=> 'gallery',
    ])
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>gallery List</h5>
                    </div>
                    <div class="ibox-content ibox-content-custom">
                        @include('admin.gallery.partials.table')
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
                title: 'Application : Gallery Print'
            },
            ajax: {
                url: '{{ route('admin.gallery.index') }}',
                dataType: 'json',
                type: 'GET',
                data: function (data) {
                    data._token = '{{ csrf_token() }}'
                }
            },
            columns: [
                { data: 'checkbox', orderable: false, width: "5%" },
                { data: 'name', orderable: true },
                { data: 'thumbnail', orderable: false },
                { data: 'content', orderable: true },
                { data: 'status', orderable: true },
                { data: 'created_by', orderable: true },
                { data: 'created_at', orderable: true },
                { data: 'action', orderable: false },
            ],
            order: [[ 0, 'desc' ]]
        };
    </script>
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/list.js') }}"></script>
@endpush
