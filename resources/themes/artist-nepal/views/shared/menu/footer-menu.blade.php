<div class="inner">
    @foreach($footerMenu as $menu)
        <a href="{{ $menu->getUrl() }}"
           class="menu-item {{ $menu->class }}"
           data-target="{{ $menu->target }}" target="{{ \Foundation\Lib\Nav::only($menu->target, false, 'targets') }}"
        >
            {{ $menu->label }}
        </a>
    @endforeach
</div>
