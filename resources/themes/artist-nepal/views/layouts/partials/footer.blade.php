<footer class="pr__footer" id="site-footer">

    <div class="pr__footer__top uk-section uk-section-large">
        <div class="section-outer">
            <div class="uk-container">
                <div class="section-inner">
                    <div class="columns uk-grid" data-uk-grid="">
                        <div class="pr__cta column">
                            <div class="inner">
                                <h2 class="title uk-h1">Let's Talk?</h2>
                            </div>
                        </div>
                        <div class="pr__cta column">
                            <div class="inner">
                                <a id="pr__contact" href="{{ route('contact') }}"
                                   class="button uk-button uk-button-large uk-button-default">
                                    Make an enquiry
                                </a>
                            </div>
                        </div>
                        <div class="pr__social column">
                            <div class="inner">
                                @foreach(\Foundation\Builders\Cache\Meta::toArray('social') as $socialPlatform => $socialLink)
                                    @if(!empty($socialLink))
                                        <a href="{{ $socialLink }}" target="_blank"
                                            rel="noreferrer noopener" class="icon pr-logo-{{ $socialPlatform }}"></a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- Inner End-->
            </div><!-- Container End-->
        </div><!-- Outer End-->
    </div>
    <div class="pr__footer__center uk-section uk-section-small">
        <div class="uk-container">

            <ul>
                <li>
                    <a href="tel:{{ \Foundation\Builders\Cache\Meta::get('email') }}">
                        {{ \Foundation\Builders\Cache\Meta::get('location') }}
                        <span class="phone">{{ \Foundation\Builders\Cache\Meta::get('email') }}</span>
                    </a>
                </li>
                <li>
                    <a href="tel:{{ \Foundation\Builders\Cache\Meta::get('usa_email') }}">
                        {{ \Foundation\Builders\Cache\Meta::get('secondary_location') }}
                        <span class="phone">{{ \Foundation\Builders\Cache\Meta::get('usa_email') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="pr__footer__bottom uk-section">
        <div class="section-outer">
            <div class="uk-container">
                <div class="section-inner">
                    <div class="columns uk-grid" data-uk-grid="">
                        <div class="pr__links column">
                            <x-footer-menu />
                        </div>
                        <div class="pr__copyrights column">
                            <div class="inner">
                                <p>{{ date('Y') }} © <a href="{{ url('/') }}">Artist Nepal</a>, All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- Inner End-->
            </div><!-- Container End-->
        </div><!-- Outer End-->
    </div>

</footer>
