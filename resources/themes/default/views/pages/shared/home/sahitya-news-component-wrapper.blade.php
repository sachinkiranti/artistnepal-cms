<div class="container" data-component-wrapper="{{active_lang() == 'np' ? '' : 'en-'}}sahitya-news-component-wrapper">

    <section class="sahitya-news">
        <div class="row">
            <div class="col-5">
                {!! $components[(active_lang() == 'np' ? '' : 'en-').'literature-left-section-component'] ?? '' !!}
            </div>
            <div class="col-7">
                {!! $components[(active_lang() == 'np' ? '' : 'en-').'literature-right-section-component'] ?? '' !!}
            </div>
        </div>
    </section>

</div>
