@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp

<div data-component="sochai" class="bichar-v2">

    @include('pages.shared.home.editor')

    <div class="title bg-green">
        <h4>{{ $title ?? '' }} </h4>
        @isset($category)
        <a href="{{ route('archive', ['slug' => $category]) }}" title="">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
        @endisset
    </div>
    <!-- /title -->
    <div class="row">
        @forelse ($data['posts'] as $post)
            <div class="col-4">
                <div class="bichar">
                    <div class="bichar-head">
                        @if ($post->isThumbnailVisible())
                            @if ($post->image)
                                <div class="bichar-media">
                                    <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="{{ $post->title }}">
                                </div>
                            @endif
                        @endif
                        <div class="bichar-title">
                            <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
                            <span class="article-meta"><span class="top-author-list"> {{ ucfirst($post->author_full_name) }}</span> {!! date_by_lang($post->created_at) !!} </span>
                        </div>

                    </div>

                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
