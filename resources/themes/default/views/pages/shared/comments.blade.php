@if ($data['post']->isSiteCommentOpened() || $data['post']->isFacebookCommentOpened() || $data['post']->isDisqusCommentOpened())
<div class="comment-wrap">
    <h3>{{ __('प्रतिक्रिया') }}</h3>
    <div class="tab">
        @if ($data['post']->isSiteCommentOpened())
            <button class="tablinks active" id="tab-comment-activate-pratikirya" data-comment="pratikirya">{{ __('हिमालय प्रतिक्रिया ') }}</button>
        @endif
        @if ($data['post']->isFacebookCommentOpened())
            <button class="tablinks {{ (!$data['post']->isSiteCommentOpened() && !$data['post']->isDisqusCommentOpened()) ? 'active' : '' }}" id="tab-comment-activate-facebook" data-comment="facebook">{{ __('फेसबूक प्रतिक्रिया ') }}</button>
        @endif
        @if ($data['post']->isDisqusCommentOpened())
            <button class="tablinks {{ !$data['post']->isSiteCommentOpened() ? 'active' : '' }}" id="tab-comment-activate-disqus" data-comment="disqus">{{ __('Disqus प्रतिक्रिया ') }}</button>
        @endif
    </div>

    @if ($data['post']->isSiteCommentOpened())
        @include('pages.shared.comments.default')
    @endif

    @if ($data['post']->isDisqusCommentOpened())
        @include('pages.shared.comments.disqus', [
            'pageUrl'           => $url,
            'pageIdentifier'    => $identifier,
            'webIdentifier'     => $webIdentifier
        ])
    @endif

    @if ($data['post']->isFacebookCommentOpened())
        @include('pages.shared.comments.facebook')
    @endif
</div>
@endif
