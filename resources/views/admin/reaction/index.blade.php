@extends('admin.layouts.master')

@push('css')
    <style>
        .pagination {text-align: center;}
    </style>
@endpush

@section('title', 'Reaction Timeline')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Reaction Timeline</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.reaction.index') }}">Reaction</a>
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
                        <h5>Reaction Timeline</h5>
                    </div>
                    <div class="ibox-content">
                        @forelse ($data['reactions'] as $reaction)
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-3 date">
                                    <i class="fa fa-clock-o"></i>
                                    {{ $reaction->created_at->format('H:m:s A') }}
                                    <br>
                                    <small class="text-navy">{{ $reaction->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="col-9 content">
                                    <p class="m-b-xs"><strong><a href="{{ route('admin.post.show', $reaction->reactable->id) }}">
                                                {{ $reaction->reactable->title }}</a></strong></p>
                                    <img src="{{ asset('images/frontend/'. strtolower(\Foundation\Lib\Reaction::$current[$reaction->type]) .'.svg') }}"
                                         title="{{ \Foundation\Lib\Reaction::$current[$reaction->type] }}" alt="{{ \Foundation\Lib\Reaction::$current[$reaction->type] }}">
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="hr-line-dashed"></div>

                            <p class="text-center">No Reactions!</p>
                        @endforelse

                        <div class="hr-line-dashed"></div>
                        <div class="text-xs-center">
                            {{ $data['reactions']->links() }}
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


