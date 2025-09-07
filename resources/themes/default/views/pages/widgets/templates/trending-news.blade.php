@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
<div data-component="trending-news" class="trending" style="{{ config('wizard.widget.every_div_style') }}">
    @include('pages.shared.home.editor')

    <div class="title bg-blue">
        <h4>{{ $title ?? '' }}</h4>
    </div>
    <!-- /title -->

    @forelse($data['posts'] as $post)

        @include('pages.widgets.templates.common.top-ad', [
            'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
        ])

        <div class="sm-news-item hover-inner">
            @if ($post->isThumbnailVisible())
                @if ($post->image)
                    <div class="sm-img hover-holder">
                        <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="{{ $post->unique_identifier }}">
                    </div>
                @endif
            @endif

            <div class="tending-docs">
                <div class="timeCat"><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">समाज ,</a>  {!! date_by_lang($post->created_at) !!}</div>
                <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
            </div>
        </div>
        @include('pages.widgets.templates.common.bottom-ad', [
            'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
        ])
    <!-- sm news -->
    @empty
    @endforelse

</div>
<!-- /trending -->
