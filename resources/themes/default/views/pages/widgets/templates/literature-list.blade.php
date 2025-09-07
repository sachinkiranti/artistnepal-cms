@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
@include('pages.shared.home.editor')

<div data-component="literature-list"  class="title title-sahitya-news bg-cyan">
    <h4>{{ $title ?? '' }}</h4>
</div>
<!-- /title -->

@forelse ($data['posts'] as $post)
    <div class="sahitya-item-full">
        <h3><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h3>
        @if ($post->isThumbnailVisible())
            @if ($post->image)
                <div class="sahitya-img">
                    <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                        <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}">
                    </a>
                </div>
            @endif
        @endif
        <div class="sahitya-content">

            <span class="article-meta"><span class="top-author-list"> {{ ucfirst($post->author_full_name) }}</span> {!! date_by_lang($post->created_at) !!}</span>
            <p>{!! ($post->secondary_title !== 'NULL' ? $post->secondary_title : null) ??
                    (resolve_description($post->content, 100) !== 'NULL' ? resolve_description($post->content, 100) : null)?? '' !!}</p>
        </div>

    </div>
@empty
@endforelse

