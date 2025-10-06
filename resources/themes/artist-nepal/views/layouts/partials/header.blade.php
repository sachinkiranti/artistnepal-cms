<div class="promo promo--white">
    <div class="promo__content">
        <header class="pr__header pr__dark">
            <div class="uk-container">
                <div class="inner">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <div class="brand"></div>
                        </a>
                    </div>

                    <x-primary-menu />

                    <div class="navbar-tigger" data-uk-toggle="target: #navbar-mobile">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </header><!-- Site Header End -->
    </div>
    <div class="promo__bck">
        <img src="@yield('promo-banner', \Foundation\Lib\Cache::image('default_banner'))" />
    </div>
    <div class="promo__content promo__content--bottom">
        <div class="promo__container ">
            <div class="promo__container--small">
                @yield('promo-container')
            </div>

        </div>
    </div>
</div>
