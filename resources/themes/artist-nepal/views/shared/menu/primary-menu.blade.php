<div class="navbar pr-font-second">
    <nav class="menu" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
        <ul id="menu-primary-1" class="">
            @foreach($primaryMenu as $menu)
                <li
                    class="menu-item {{ $menu->class }}"
                >
                    <a href="{{ $menu->getUrl() }}"
                       data-target="{{ $menu->target }}"
                       target="{{ \Foundation\Lib\Nav::only($menu->target, false, 'targets') }}">
                        {{ $menu->label }}
                    </a>
                </li>
            @endforeach

            @if(auth()->check() && auth()->user()->hasRole(\App\Foundation\Enums\Role::ROLE_ARTIST->value))
                <li
                    class="menu-item menu-item--primary"
                >
                    <a href="{{ route('artist.profile') }}">
                        <i class="fa fa-user"></i> My Profile
                    </a>
                </li>

                    <li
                        class="menu-item menu-item--primary"
                    >
                        <a href="javascript:void(0);"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {!! csrf_field() !!}
                        </form>
                    </li>
            @endif
        </ul>
    </nav>
</div>
