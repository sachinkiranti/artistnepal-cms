@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
@include('pages.shared.home.editor')
<div class="nrn-sec">
    <div class="title bg-blue title-gray ">
        <h4><span>{{ $title ?? '' }} </span></h4>
    </div>

    @forelse ($data['posts'] as $post)
        @if ($loop->first)
        <figure class="featured-photo">
            <div class="overlay"></div>
            @if ($post->isThumbnailVisible())
                @if ($post->image)
                    <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" >
                @endif
            @endif
            <figcaption>
                <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a>
            </figcaption>
        </figure>
        @endif
    @empty
    @endforelse

    <div class="listed-img">
        <div class="row">
            @forelse ($data['posts'] as $post)
                @if (!$loop->first)
                <div class="col-4">
                    @if ($post->isThumbnailVisible())
                        @if ($post->image)
                            <figure>
                                <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" >
                            </figure>
                        @endif
                    @endif
                    <h3><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h3>
                </div>
                @endif
            @empty
            @endforelse
        </div>
    </div>
</div>
