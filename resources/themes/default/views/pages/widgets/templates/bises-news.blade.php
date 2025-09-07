@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
@include('pages.shared.home.editor')

<div data-component="list-with-image" class="title bg-purple">
    <h4>{{ $title ?? '' }}</h4>
    @isset($category)
    <a href="{{ route('archive', ['slug' => \Foundation\Lib\PostType::PATTERN_BISES_NEWS]) }}" title="{{ $title ?? '' }}">
        {{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}
    </a>
    @endisset
</div>

@forelse ($data['posts'] as $post)

    @include('pages.widgets.templates.common.top-ad', [
        'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
    ])

    <!-- /title -->
    <div class="news-item hover-inner" style="{{ config('wizard.widget.every_div_style') }}">
        @if ($post->isThumbnailVisible())
            @if ($post->image)
                <div class="sm-img hover-holder">
                    <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" alt="">
                </div>
            @endif
        @endif

        <div class="timeCat">
            <a href="{{ route('archive', ['slug' => $post->category_identifier,]) }}" title="{{ $post->title }}">{{ $post->category_name }} ,</a>
            {!! date_by_lang($post->created_at) !!}</div>
        <h4>
            <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a>
        </h4>
        <p>
            <span class="article-meta"><span class="top-author-list"> {{ ucfirst($post->author_full_name) }}</span> {!! date_by_lang($post->created_at) !!} - </span>
            {{ (resolve_description($post->content) !== 'NULL' ? resolve_description($post->content, 200) : null) ?? '' }}
        </p>
    </div>
    <!-- sm news -->

    @include('pages.widgets.templates.common.bottom-ad', [
        'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
    ])

@empty
@endforelse

