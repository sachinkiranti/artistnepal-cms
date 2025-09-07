<p class="foot-link">
    @foreach($rightFooterMenu as $menu)

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

        <a href="{{ url($url) ?? '#' }}" title="{{ $label }}">{{ $label }}</a> @if (!$loop->last) | @endif
    @endforeach
</p>
