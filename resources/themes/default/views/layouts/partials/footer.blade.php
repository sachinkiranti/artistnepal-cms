<footer id="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-3">
{{--                {!! $components[(active_lang() == 'np' ? '' : 'en-').'footer-left-section-component'] ?? '' !!}--}}
                <div class="foot-panel">
                    <h4>सम्पर्क ठेगाना</h4>
                    <div class="address-info">
                        <h5>{{ \Foundation\Builders\Cache\Meta::get('company') }}</h5>
                        <p> {{ \Foundation\Builders\Cache\Meta::get('location') }} <br><a class="text-white" href="{{ \Foundation\Builders\Cache\Meta::get('domain') }}">{{ str_replace([ 'https://', 'http://', ], '', \Foundation\Builders\Cache\Meta::get('domain')) }}</a></p>
                    </div>
                    <div class="address">
                        <h5>अमेरिका</h5>
                        <p class="phone">
                            <a class="text-white"  href="tel:{{ \Foundation\Builders\Cache\Meta::get('mobile') }}">{{ \Foundation\Builders\Cache\Meta::get('mobile') }}</a>
                        </p>
                        <p class="email">
                            <a class="text-white"  href="mailto:{{ \Foundation\Builders\Cache\Meta::get('email') }}?subject=Emailed from Site">{{ \Foundation\Builders\Cache\Meta::get('email') }}</a>
                        </p>
                    </div>
                    <div class="address">
                        <h5>नेपाल</h5>
                        <p class="phone">
                            <a class="text-white"  href="tel:{{ \Foundation\Builders\Cache\Meta::get('phone') }}">{{ \Foundation\Builders\Cache\Meta::get('phone') }}</a>
                        </p>
                        <p class="address">{{ \Foundation\Builders\Cache\Meta::get('secondary_location') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                @footerMenu @endfooterMenu
{{--                {!! $components['footer-middle-section-component'] ?? '' !!}--}}
            </div>
            <div class="col-6">
{{--                {!! $components['footer-right-section-component'] ?? '' !!}--}}
                @team @endteam
            </div>
        </div>

    </div>
    <div class="foot-bottom">
        <div class="container">
            <p class="copy-text">{{ \Foundation\Builders\Cache\Meta::get('copyright-text') }}</p>
            @rightFooterMenu @endrightFooterMenu
        </div>
    </div>
</footer>

<script src="{{ theme_asset('js/app.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        $("img.lazy").lazyload();
    });
    $('.widget-sub-item').click(function() {
        var src = $(this).find('iframe').attr('src');
        $('#video-frame iframe').attr('src', src);
    });
    $('.moreless-button').click(function() {
        var $this = $(this);
        $('.morelink').slideToggle();
        if ($this.text() == "Show Less") {
            $this.text("Show More")
        } else {
            $this.text("Show Less")
        }
    });
    $('.embed-responsive-item').width('100%');
</script>
@stack('scripts')
</body>
</html>
