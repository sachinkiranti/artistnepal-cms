@extends('admin.layouts.master')

@push('css')
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
        .label-sub-primary:hover{

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

@section('title', 'Category')

@section('content')

@include('admin.common.breadcrumbs', [
'title' => 'Show',
'panel' => 'category',
'id'    => $data['category']->id,
])

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">

                <div class="ibox-content ibox-content-custom">
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

                        {{--                        @if(isset($data['getCategoryName']['parent']['category_name']))--}}
{{--                            <tr>--}}
{{--                                <td style="width:35%;">Category</td>--}}
{{--                                <td style="width:65%">--}}
{{--                                    <a href="{{ route("admin.category.show", $data['getCategoryName']['parent']['id']) }}" class="label label-primary tag-href">--}}
{{--                                        {!! $data['getCategoryName']['parent']['category_name'] !!}--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}

{{--                        @if(isset($data['getCategoryName']['child']['category_name']))--}}
{{--                            <tr>--}}
{{--                                <td style="width:35%;">Sub Category</td>--}}
{{--                                <td style="width:65%">--}}
{{--                                    <a href="{{ route("admin.category.show", $data['getCategoryName']['child']['id']) }}" class="label label-sub-primary tag-href">--}}
{{--                                        {!! $data['getCategoryName']['child']['category_name'] !!}--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endif--}}

                        <tr>
                            <td style="width:35%;">Description</td>
                            <td style="width:65%">{!! $data['category']->description !!} </td>

                        </tr>

                        <tr>
                            <td style="width:35%;">Status</td>
                            <td style="width:65%" >
                                @include('admin.common.show-status' , [
                                    'model' => 'category',
                                ])
                            </td>
                        </tr>

                        <tr>
                            <td style="width:35%;">Created By</td>
                            <td style="width:65%">
                                @php
                                    $fullName = $data['category']->user ? ($data['category']->user->first_name.' '.$data['category']->user->middle_name.' '.$data['category']->user->last_name) : 'No User details found';
                                    echo $fullName;
                                @endphp
                            </td>

                        </tr>

                        <tr>
                            <td style="width:35%;">Total Post </td>
                            <td style="width:65%">
                                @if($data['category']->posts_count > 0)
                                    <a href="{{ route("admin.post.index", ['category_id' => $data['category']->id ]) }}" class="label label-primary label-href">{{ $data['category']->posts_count }}</a>
                                @else
                                    <a href="javascript:void(0);" class="label label-primary label-href-No">{{ $data['category']->posts_count }}</a>
                                @endif
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    @include('admin.common.action.delete' , ['route' => 'admin.category.destroy', 'id' => $data['category']->id, ])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('dist/js/show.js') }}"></script>
@endpush
