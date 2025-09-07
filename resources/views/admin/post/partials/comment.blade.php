<div class="social-feed-box">

    <div class="float-right social-action dropdown">
        <button data-toggle="dropdown" class="dropdown-toggle btn-white">
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu m-t-xs">
            <li><a href="#">Config</a></li>
        </ul>
    </div>
    <div class="social-avatar">
        <strong>{{ $data['post']->title }}</strong>
        <code>{{ $data['post']->created_at->diffForHumans() }} {{ $data['post']->created_at->format('H:m:s A - m.d.Y') }}</code>
    </div>
    <div class="social-body">
        {!! $data['post']->content !!}
{{--        <img src="img/gallery/9.jpg" class="img-fluid">--}}
{{--        <div class="btn-group">--}}
{{--            <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>--}}
{{--            <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>--}}
{{--            <button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>--}}
{{--        </div>--}}
    </div>
    <div class="social-footer">

        @forelse ($data['post']->comments as $comment)
        <div class="social-comment">
            <div class="float-left">
                <img alt="image" src="{{ asset('images/admin/user-default.png') }}">
            </div>
            <div class="media-body">
                <a href="#">
                    {{ $comment->full_name ?? 'Admin' }}
                </a>
                {{ $comment->comment }}
                <br>
                <small class="text-muted">{{ $comment->created_at->format('- m.d.Y') }}</small>
            </div>
        </div>
        @empty

        @endforelse

        <div class="social-comment">
            <div class="float-left">
                <img alt="image" src="{{ asset('images/admin/user-default.png') }}">
            </div>
            <div class="media-body">
                {!! Form::open(['route' => 'admin.actions.comment',
                        'enctype' => 'multipart/form-data', 'method' => 'POST', 'id' => 'commentForm']) !!}
                <input type="hidden" name="post-id" value="{{ $data['post']->unique_identifier }}">
                <input type="hidden" name="post-signature">
                <textarea name="comment-box" class="form-control" placeholder="Write comment..."></textarea> <br>
                <button  type="submit" class="btn btn-primary btn-xs"> <i class="fa fa-save"></i> Save </button>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

</div>
