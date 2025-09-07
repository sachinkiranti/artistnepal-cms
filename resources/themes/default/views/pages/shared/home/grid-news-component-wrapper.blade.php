<div class="container" data-component-wrapper="{{ active_lang() == 'np' ? '' : 'en-' }}grid-news-component">

    <div class="row grid-news">
        <div class="col-4 more-content">
            {!! $components[(active_lang() == 'np' ? '' : 'en-').'left-section-component'] ?? '' !!}
        </div>
        <!-- /col-4 -->
        <div class="col-4">
            {!! $components[(active_lang() == 'np' ? '' : 'en-').'middle-section-component'] ?? '' !!}
        </div>
        <!-- /col-4 -->
        <div class="col-4">
            {!! $components[(active_lang() == 'np' ? '' : 'en-').'right-section-component'] ?? '' !!}
        </div>
        <!-- /col-4 -->
    </div>
    <!-- /grid-news -->

</div>
