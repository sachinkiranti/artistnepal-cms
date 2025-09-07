@extends('admin.layouts.master')

@push('css')
    <style>
        .ibox-content-custom {
            padding: 25px 20px 15px 20px;
        }
        .change-status{
            cursor: pointer;
        }
        .label-href-No:hover
        {
            color: white;
            cursor: default;
        }
        .label-href:hover {
            color: white;
        }
    </style>
@endpush

@section('title', 'Tag')

@section('content')
    @include('admin.common.breadcrumbs', [
        'title'=> 'Show',
        'panel'=> 'tag',
        'id'   => $data['tag']->id,
    ])
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">

                    <div class="ibox-content ibox-content-custom">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="150px">Labels</th>
                                <th>Information</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="width:35%;">Name</td>
                                <td style="width:65%">{{ $data['tag']->tag_name }}</td>
                            </tr>
                            <tr>
                                <td style="width:35%;">Description</td>
                                <td style="width:65%">{!! $data['tag']->description !!} </td>

                            </tr>
                            <tr>
                                <td style="width:35%;">Status</td>
                                <td style="width:65%" >
                                @include('admin.common.show-status' , [
                                    'model' => 'tag',
                                ])
                                </td>
                            </tr>

                            <tr>
                                <td style="width:35%;">Total Post</td>
                                <td style="width:65%">
                                    @if($data['tag']->posts_count > 0)
                                        <a href="{{ route("admin.post.index", ['tag_id' => $data['tag']->id ]) }}" class="label label-primary label-href">{{ $data['tag']->posts_count }}</a>
                                    @else
                                        <a href="javascript:void(0);" class="label label-primary label-href-No">{{ $data['tag']->posts_count }}</a>
                                    @endif
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        @include('admin.common.action.delete' , ['route' => 'admin.tag.destroy', 'id' => $data['tag']->id, ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/js/show.js') }}"></script>
@endpush
