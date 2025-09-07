@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp

@include('pages.shared.home.editor')
    @if ($data['posts']->isNotEmpty())
    <div class="title">
        <h4>{{ $title ?? ''}} </h4>
        <a href="{{ route('gallery') }}" title="{{ $title ?? '' }}">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
    </div>
    <!-- /title -->
    <div data-component="gallery" class="row image-gallery">

        @foreach ($data['posts'] as $post)

            <div class="col-3">
                <div class="item-image">
                    <a href="{{ route('gallery', $post->unique_identifier) }}" title="" class="img-view">
                        <img class="lazy" data-src="{{ asset( 'storage/images/gallery/'.$post->thumbnail ) }}" alt="{{$post->title}}">
                    </a>
                    <h3><a href="{{ route('gallery', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->name }}</a></h3>
                </div>
                <!-- /item -->
            </div>
        @endforeach

    </div>
@endif
