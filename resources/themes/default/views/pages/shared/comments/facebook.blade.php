<div id="facebook" class="tabcontent" style="{{ (!$data['post']->isSiteCommentOpened() && !$data['post']->isDisqusCommentOpened()) ? 'display: block;' : '' }}">
    <div class="fb-comment">
        <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>
    </div>
</div>
