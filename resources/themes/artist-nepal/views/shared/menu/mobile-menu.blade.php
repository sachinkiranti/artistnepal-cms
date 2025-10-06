<div class="pr__mobile__nav" id="navbar-mobile" data-uk-offcanvas="overlay: true; flip: true; mode: none">
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close" type="button" data-uk-close="ratio: 2;"></button>

        <nav class="menu" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
            <ul id="menu-primary" class="">
                @foreach($mobileMenu as $menu)
                    <li
                        class="menu-item {{ $menu->class }}"
                    >
                        <a
                            href="{{ $menu->getUrl() }}"
                            data-target="{{ $menu->target }}" target="{{ \Foundation\Lib\Nav::only($menu->target, false, 'targets') }}"
                        >{{ $menu->label }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

    </div><!-- Off Canvas Bar End -->
</div>
