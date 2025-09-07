@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
<div data-component="Video" class="container">

    @include('pages.shared.home.editor')

    <div class="title bg-blue title-white">
        <h4>{{ $title ?? '' }}</h4>
        @isset($category)
            <a href="{{ route('archive', ['slug' => $category]) }}" title="">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
        @endisset
    </div>
    <div class="row">
        <div class="col-7">
            @forelse ($data['posts'] as $post)
                @if ($loop->first)
                    <div class="widget-video hover-inner">
                        @if ($post->isThumbnailVisible())
                            @if ($post->image)
                                <div class="feat-img hover-holder">
                                    <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}" class="play-btn"></a>
                                    <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="">
                                </div>
                            @endif
                        @endif
                        <div class="feat-content">
                            <h3><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h3>
                            <p>
                                <span class="article-meta">{!! date_by_lang($post->created_at) !!} - </span>
                                {{ resolve_description($post->content, 200) }}
                            </p>
                        </div>
                    </div>
                    @break
                @endif
            @empty
            @endforelse
        </div>
        <!-- /col8 -->
        <div class="col-5">
            @forelse ($data['posts'] as $post)
                @if ($loop->iteration > 1)
                    <div class="widget-sub-item">
                        <div class="sub-widget-img">
                            <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}" class="play-btn"></a>
                            @if ($post->isThumbnailVisible())
                            <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                                <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="{{ $post->title }}">
                            </a>
                            @endif
                        </div>
                        <div class="sub-widget-content">
                            <p><span class="article-meta"><span class="top-author-list">{{ ucfirst($post->author_full_name) }}</span> {!! date_by_lang($post->created_at) !!}</span></p>
                            <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}"> {{ $post->title }}  </a></h4>
                        </div>
                    </div>
                    <!-- /widget sub item -->
                @endif
            @empty
            @endforelse
        </div>
        <!-- /col4 -->
    </div>
</div>
