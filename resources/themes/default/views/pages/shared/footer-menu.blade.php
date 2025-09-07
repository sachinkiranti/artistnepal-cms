<div class="foot-panel">
    <h4>समागृहरु</h4>
        @foreach($footerMenu->chunk(10) as $menus)

                <ul class="@if(!$loop->first) morelink @endif foot-menu" @if(!$loop->first) style="display: none;" @endif>
                    @foreach ($menus as $menu)
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

                        <li>
                            <a href="{{ url($url) ?? '#' }}" data-target="{{ $menu->target }}" target="{{ \Foundation\Lib\Nav::only($menu->target, false, 'targets') }}">{{ $label }}</a>
                        </li>
                    @endforeach

                        @if($loop->first)
                        <li>
                            <a class="moreless-button" href="javascript:void(0)">Show More</a>
                        </li>
                        @endif
                </ul>
        @endforeach
</div>
