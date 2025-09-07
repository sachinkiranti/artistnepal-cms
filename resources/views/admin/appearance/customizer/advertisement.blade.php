@extends('admin.layouts.master')

@push('css')
    <style>
        .advertisement-manager .hr-line-dashed {
            border-top: 0;
            color: #f8fafb;
            background-color: #f8fafb;
        }
    </style>
@endpush

@section('title', 'Advertisement')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-6">
            <h2>Advertisement</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
            </ol>
        </div>
    </div>

    {!!
        app('form')->model($data, [
            'enctype' => 'multipart/form-data',
            'route'   => [ 'admin.advertisement.save' ],
            'method'  => 'POST',
            'role'    => 'form'
        ]);
    !!}

    {!! app('form')->hidden('widget', $data['widget']->widget_id) !!}
    {!! app('form')->hidden('component', $data['widget']->component) !!}

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="advertisement-manager">
                    @isset($data['posts'])

                        @forelse($data['posts'] as $post)

                            @include('admin.appearance.customizer.partials.advertisement', [
                                'bottomAds'   => $data['widget']->advertisement[$loop->index]['bottom'] ?? null,
                                'topAds'      => $data['widget']->advertisement[$loop->index]['top'] ?? null,
                                'widgetId'    => $data['widget']->widget_id ?? null,
                                'widgetTitle' => $post->title ?? null,
                                'widgetDesc'  => \Illuminate\Support\Str::limit(strip_tags($post->content), '50', '...')  ?? null,
                                'postId'      => $post->unique_identifier,
                            ])

                            @empty

                            <p class="text-center">No Posts!</p>

                        @endforelse


                    @else
                        @include('admin.appearance.customizer.partials.advertisement', [
                            'bottomAds' => $data['widget']->advertisement['bottom'] ?? null,
                            'topAds'    => $data['widget']->advertisement['top'] ?? null,
                            'widgetId'  => $data['widget']->widget_id ?? null,
                            'widgetTitle' => $data['widget']->title ?? null,
                            'widgetDesc' => $data['widget']->description ?? null,
                        ])
                    @endisset

                    <br>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    {!! app('form')->close() !!}
@endsection

@push('js')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('dist/js/advertisement-manager.js') }}"></script>
@endpush
