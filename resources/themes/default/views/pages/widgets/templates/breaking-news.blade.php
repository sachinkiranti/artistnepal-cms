@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp

@include('pages.shared.home.editor')

@forelse ($data['posts'] as $post)

    @include('pages.widgets.templates.common.top-ad', [
        'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? [],
        'index'             => $loop->index,
        'widget'            => ''
    ])

    <div data-identifier="{{ array_get($data['widget'], 'widget.id') }}" data-component="breaking-news" class="flash-news" style="{{ config('wizard.widget.every_div_style') }}">
{{--        @if ($loop->first && active_lang() != 'en')--}}
            <span class="tag-head"><a style="color: #FFF;" href="{{ route('archive', ['slug' => $post->category_identifier]) }}" title="{{ $post->title ?? '' }}">{{ $post->category_name }}</a></span>
{{--        @endif--}}
        <h2><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h2>
            <h5 style="color: rgba(0,0,0,.5);">{{ $post->secondary_title }}</h5>
        <ul class="flash-meta">
{{--            <li>--}}
{{--                @isset($post->category_name)--}}
{{--                    <a href="{{ route('archive', ['slug' => $post->category_identifier]) }}" title="{{ $post->title ?? '' }}">--}}
{{--                        {{ $post->category_name }}--}}
{{--                    </a>--}}
{{--                @endisset--}}
{{--            </li>--}}
            @if ($post->isAuthorVisible())
            <li>
                <a href="{{ $post->author ? 'javascript::void(0)' : author_url($post->author_identifier) }}" title="">
                    <span class="author-img">
                        <img src="{{ asset('images/admin/user-default.png') }}" alt="{{ $post->author ?? $post->author_full_name }}">
                    </span>
                    <label>{{ ucfirst($post->author ?? $post->author_full_name) }}</label>
                </a>
            </li>
            @endif
            <li>
                <span class="post-time">{!! date_by_lang($post->updated_at) !!}</span>
            </li>
        </ul>

            @if ($post->isThumbnailVisible())
                @if ($post->image)
                    <div class="imgItem">
                        <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                        <img class="lazy" src="{{ get_thumbnail('/ntg.png') }}" data-src="{{ resolve_image($post->image, $post->unique_identifier) }}" alt="{{ $post->title }}">
                        </a>
                    </div>
                @endif
            @endif
        <div class="docs">
            <p>
                {{ resolve_description($post->content, 200) }}
            </p>
        </div>
    </div>
    <!-- /flash item -->

    @include('pages.widgets.templates.common.bottom-ad', [
        'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? [],
        'index'                => $loop->index,
    ])
@empty
    @foreach(range(1, ($limit ?? 1)) as $index)
        @include('pages.widgets.templates.common.top-ad', [
            'topAdvertisements' => $topAdvertisements ?? $advertisement[$index]->top ?? [],
            'index'             => $index,
            'widget'            => ''
        ])
        @include('pages.widgets.templates.common.bottom-ad', [
            'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$index]->bottom ?? [],
            'index'                => $index,
        ])
    @endforeach
@endforelse
