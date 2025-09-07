@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
@include('pages.shared.home.editor')

<div data-component="literature-grid" class="title title-sahitya-shirjhana bg-teal">
    <h4>{{ $title ?? '' }}</h4>
</div>
<!-- /title -->
<div class="row">
    @forelse ($data['posts'] as $post)
        <div class="col-4">
            <div class="sahitya-item">
                <span class="sahitya-tag">{{ $post->category_name }}</span>
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
                    <h5><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h5>
                    <span class="sahitya-tag">{{ $post->secondary_title }}</span>
                </div>

            </div>
        </div>
    @empty
    @endforelse
</div>
