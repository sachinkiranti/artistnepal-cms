@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp

<div data-component="featured-news" class="container">
    @include('pages.shared.home.editor')

    <div class="title bg-blue title-gray">
        <h4><span>{{ $title ?? '' }} </span></h4>
    </div>
    <!-- /title -->
    <div class="row">
        @forelse ($data['posts'] as $post)

            @include('pages.widgets.templates.common.top-ad', [
                'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
            ])

            <div class="col-3">
                <div class="feature-item hover-inner">
                    @if ($post->isThumbnailVisible())
                        @if ($post->image)
                            <div class="post-img hover-holder">
                                <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                                    <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="">
                                </a>
                            </div>
                        @endif
                    @endif
                    <div class="post-content">
                        <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
                    </div>
                </div>
                <!-- /feature item -->
            </div>
            <!-- /col -->
            @include('pages.widgets.templates.common.bottom-ad', [
                'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
            ])
        @empty
        @endforelse
    </div>
</div>
