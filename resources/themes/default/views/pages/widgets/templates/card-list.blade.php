@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
@include('pages.shared.home.editor')
<div class="card-img">
    <div class="title bg-blue title-gray ">
        <h4><span>{{ $title ?? '' }} </span></h4>
    </div>
    <div class="row">
        @forelse ($data['posts'] as $post)
            <div class="col-4">
                @if ($post->isThumbnailVisible())
                    @if ($post->image)
                    <figure>
                        <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" >
                    </figure>
                    @endif
                @endif
                <h5><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h5>
            </div>
        @empty
        @endforelse
    </div>
</div>
