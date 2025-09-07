@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
<div class="card-news bibidh-feature" data-component="list-with-left-side-image">
    @include('pages.shared.home.editor')

    <div class="title">
        <h4>{{ $title ?? '' }}</h4>
        @isset($category)
        <a href="{{ route('archive', ['slug' => $category]) }}" title="{{ $title ?? '' }}">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
        @endisset
    </div>
    <!-- /title -->

    @forelse ($data['posts'] as $post)

        @include('pages.widgets.templates.common.top-ad', [
            'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
        ])

        <div class="card-item hover-inner">
            @if ($post->isThumbnailVisible())
                @if ($post->image)
                <div class="bichar-img hover-holder">
                    <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                        <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" alt="{{ $post->title }}">
                    </a>
                </div>
                @endif
            @endif
            <div class="bichar-docs">
                <h4>
                    <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                </h4>
                <p><span class="article-meta"><span class="top-author-list"> {{ ucfirst($post->author_full_name) }}</span> {!! date_by_lang($post->created_at) !!}</span></p>
            </div>

        </div>
        <!-- /card -->

        @include('pages.widgets.templates.common.bottom-ad', [
            'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
        ])

    @empty
    @endforelse

</div>
