<div id="pratikirya" class="tabcontent" style="display: block;">
    {!! Form::open(['route' => 'feedback', 'method' => 'post', 'id' => 'commentForm']) !!}
        <input type="hidden" name="signature" id="signature" class="form-control">
        <input type="hidden" name="post_id" id="signature"  value="{{ $data['post']->id }}" class="form-control">

        <div class="form-group">
            <label for="fullname">पुरानाम *</label>
            {!! Form::text('full_name', null, [ 'class' => 'form-control comment-full_name', 'required' ]) !!}
            @if($errors->has('full_name'))
                <label class="has-error" for="full_name">{{ $errors->first('full_name') }}</label>
            @endif
        </div>
        <!-- /form group -->
        <div class="form-group">
            <label for="email">इमेल *</label>
            {!! Form::email('email', null, [ 'class' => 'form-control comment-email', 'required' ]) !!}
            @if($errors->has('email'))
                <label class="has-error" for="email">{{ $errors->first('email') }}</label>
            @endif
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="website">वेबसाईट</label>--}}
{{--            {!! Form::url('website', null, [ 'class' => 'form-control comment-website', 'required' ]) !!}--}}
{{--            @if($errors->has('website'))--}}
{{--                <label class="has-error" for="website">{{ $errors->first('website') }}</label>--}}
{{--            @endif--}}
{{--        </div>--}}

        <!-- /form group -->
        <div class="form-group">
            <label for="comment-area">प्रतिकृया *</label>
            {!! Form::textarea('comment', null, [ 'class' => 'form-control comment-comment', 'id' => 'content', 'rows' => 8, 'required' ]) !!}
            @if($errors->has('comment'))
                <label class="has-error" for="comment">{{ $errors->first('comment') }}</label>
            @endif
        </div>
        <!-- /form group -->
        <input type="submit" value="पठाउनुहोस" class="btn btn-default">
    {!! Form::close() !!}
    <div class="comment-main">
        @foreach($data['post']->comments as $comment)
        <div class="comment-item">
            <div class="comment-head">
                <h5 class="name">{{ $comment->full_name }}</h5>
                <div class="date">{!! date_by_lang($comment->created_at) !!}</div>
{{--                <a href="#" title="Reply" class="btn btn-replay">{{ active_lang() === 'np' ? 'जवाफ दिनुहोस्' : 'Reply' }}</a>--}}
            </div>
            <div class="comment-body">
                <div class="comments">
                    {{ $comment->comment }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
