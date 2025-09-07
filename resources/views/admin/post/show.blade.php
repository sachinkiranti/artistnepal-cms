@extends('admin.layouts.master')

@push('css')
    <link href="{{ asset('dist/css/plugin.css') }}" rel="stylesheet">

    <link href="{{ asset('dist/css/list.css') }}" rel="stylesheet">
    <style>
        .ibox-content-custom {
            padding: 25px 20px 15px 20px;
        }
        .change-status{
            cursor: pointer;
        }
        .label-sub-primary{
            background: #0cbf9b;
            color: white;
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


@section('title', 'Post')

@section('content')

@include('admin.common.breadcrumbs', [
'title' => 'Show',
'panel' => 'post',
'id'    => $data['post']->id,
])

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-sm-3">
            <summary>
            @slot('title') Comment @endslot

            @include('admin.common.count', [
                'key' => 'approved',
                'value' => $data['comments']->approved,
            ])

            @include('admin.common.count', [
                'key' => 'pending',
                'value' => $data['comments']->pending,
            ])

            @include('admin.common.count', [
                'key' => 'total',
                'value' => $data['comments']->total,
            ])
            </summary>
        </div>
        <div class="col-sm-3">
            <summary>
            @slot('title') Reaction @endslot

            @include('admin.common.count', [
                'key' => 'approved',
                'value' => $data['comments']->approved,
            ])

            @include('admin.common.count', [
                'key' => 'pending',
                'value' => $data['comments']->pending,
            ])

            @include('admin.common.count', [
                'key' => 'total',
                'value' => $data['comments']->total,
            ])
            </summary>
        </div>
    </div>

    <div class="ibox">
        <div class="ibox-content ibox-content-custom">
            <div class="row">
                <div class="col-sm-3">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="150px">Label</th>
                            <th>Information</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Category</td>
                            <td>
                                @forelse($data['parents'] as $parent)
                                    <span class="badge badge-primary">
                                        <a style="color: #fff;" href="{{ route("admin.category.show", $parent->id) }}">
                                            {{ $parent->category_name }}
                                        </a>
                                    </span>
                                @empty
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Views</td>
                            <td style="width:65%">{{ $data['post']->views ?? '0' }} </td>

                        </tr>
                        <tr>
                            <td style="width:35%;">Image</td>
                            <td style="width:65%">
                                <img alt="image" style="width: 120px !important;" class="img-fluid col-md-8" src="{{ asset( 'storage/images/posts/'.$data['post']->image ?? 'images/admin/default.jpg')}}">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Post Type</td>
                            <td style="width:65%">
                                <span class="label label-primary">{{ Foundation\Lib\PostType::$current[$data['post']->post_type] }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Status</td>
                            <td style="width:65%" >
                                @include('admin.common.show-status' , [
                                'model' => 'post',
                                ])
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Tags</td>
                            <td style="width:65%">
                                @forelse($data['post']->tags as $tag)
                                    <a href="{{ route("admin.tag.show", $tag->id) }}" class="label label-primary label-href">{{ $tag->tag_name }}</a>
                                @empty
                                    <a href="javascript:void(0);" class="label label-primary label-href">No Tags Assigned !</a>
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Total Tags</td>
                            <td style="width:65%">
                                @if($data['post']->tags_count > 0)
                                    <a href="{{ route("admin.tag.index", ['post_id' => $data['post']->id ]) }}" class="label label-primary label-href">{{ $data['post']->tags_count }}</a>
                                @else
                                    <a href="javascript:void(0);" class="label label-primary label-href-No">{{ $data['post']->tags_count }}</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:35%;">Total Category</td>
                            <td style="width:65%">
                                @if($data['post']->category_count > 0)
                                    <a href="{{ route("admin.category.index", ['category_id' => $data['post']->id ]) }}" class="label label-primary label-href">{{ $data['post']->category_count }}</a>
                                @else
                                    <a href="javascript:void(0);" class="label label-primary label-href-No">{{ $data['post']->category_count }}</a>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="width:35%;">Total Comments</td>
                            <td style="width:65%">
                                {{ $data['post']->comments_count }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @include('admin.common.action.delete' , [
                        'route' => 'admin.post.destroy',
                        'id'    => $data['post']->id,
                    ])
                </div>

                <div class="col-sm-9">
                    @include('admin.post.partials.comment')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/plugin.js') }}"></script>
    <script src="{{ asset('dist/js/show.js') }}"></script>
    <script src="{{ asset('dist/js/comment-manager.js') }}"></script>
    <script>
        $(function () {

            $("#commentForm").validate({
                rules: {
                    "comment-box": "required"
                },
            });

            $('#commentForm').submit(function(event) {

                event.preventDefault();

                var client = new ClientJS();

                var fingerprint = client.getFingerprint();

                $(this).find('input[name=post-signature]').val(fingerprint);

                if ($('#commentForm').valid()) {
                    $(this).unbind('submit').submit();
                }
            })

        });
    </script>
@endpush
