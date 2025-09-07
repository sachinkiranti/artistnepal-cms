@extends('admin.layouts.master')

@push('css')
    <style>
        .pagination {text-align: center;}
    </style>
@endpush

@section('title', 'Comment Timeline')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Comment Timeline</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.comment.index') }}">Comment</a>
                </li>

                <li class="breadcrumb-item">
                    <strong>Timeline</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title ibox-title-border">
                        <h5>Comment Timeline</h5>
                    </div>
                    <div class="ibox-content">
                        @forelse ($data['comments'] as $comment)
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-3 date">
                                    <i class="fa fa-clock-o"></i>
                                    {{ $comment->created_at->format('H:m:s A') }}
                                    <br>
                                    <small class="text-navy">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="col-9 content">
                                    <p class="m-b-xs"><strong><a href="{{ route('admin.post.show', $comment->commentable->id) }}">{{ $comment->commentable->title }}</a></strong></p>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="hr-line-dashed"></div>

                            <p class="text-center">No Comments!</p>
                        @endforelse

                        <div class="hr-line-dashed"></div>
                        <div class="text-xs-center">
                            {{ $data['comments']->links() }}
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush


