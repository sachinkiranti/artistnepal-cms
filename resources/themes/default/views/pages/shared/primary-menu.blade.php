<div class="nav-header">
    <button class="expand-menu expand-primary-menu" id="expand-primary-menu">
        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30"
             height="30" focusable="false"><title>Menu</title>
            <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22" />
        </svg>
    </button>
    <div class="navbar-brand">
        <img src="{{ asset( 'storage/images/setting/'.\Foundation\Lib\Cache::setting('logo')) }}" alt="logo">
    </div>
</div>

<div class="navbar-menu">
    <ul class="navbar-nav">
        @foreach($primaryMenu as $menu)

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
                <a href="{{ url($url) ?? '#' }}" class="menu-link" data-target="{{ $menu->target }}" target="{{ \Foundation\Lib\Nav::only($menu->target, false, 'targets') }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>
</div>


