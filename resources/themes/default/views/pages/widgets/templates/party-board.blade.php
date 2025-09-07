@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
<div data-component="party-board" class="suchana-information" style="{{ config('wizard.widget.every_div_style') }}">
    @include('pages.shared.home.editor')

    <h4>{{ $title ?? '' }}</h4>
    <ul>
        @foreach ($data['posts'] as $post)
            <li>
                <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                    @if ($post->is_thumbnail_visible)
                        @if ($post->image)
                            <figure class="notice-image">
                                <img src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="{{ $post->title   }}">
                            </figure>
                        @endif
                    @endif
                    {{ $post->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
