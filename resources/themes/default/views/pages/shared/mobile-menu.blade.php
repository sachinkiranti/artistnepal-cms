<aside id="sideMenu">
    <span class="closeMenu close-menu" id="close-side-menu"></span>

    <ul class="navbar-nav">

        @foreach($mobileMenu as $menu)

            @switch(\Foundation\Lib\Nav::only($menu->nav_li_type, false, 'types'))

                @case('Custom Link')
                @php
                    $label = $menu->label;
                    $url = $menu->value;
                @endphp
                @break

                @case('Page')
                @php
                    $label = $menu->label;
                    $url = route('page.single', [
                        'slug' => $menu->value,
                    ]);
                @endphp
                @break

                @case('Category')
                @php
                    $label = $menu->label;
                    $url = route('archive', [
                        'slug' => $menu->value,
                    ]);
                @endphp
                @break

                @case('Post')
                @php
                    $label = $menu->label;
                    $url = route('post.single', [
                        'slug' => $menu->value,
                    ]);
                @endphp
                @break
                @default

            @endswitch

            <li class="{{ request()->is($url) ? 'open' : '' }}">
                <a href="{{ url($url) ?? '#' }}" class="menu-link" data-type="{{ $menu->nav_li_type }}" data-target="{{ $menu->target }}" target="{{ \Foundation\Lib\Nav::only($menu->target, false, 'targets') }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>
</aside>
