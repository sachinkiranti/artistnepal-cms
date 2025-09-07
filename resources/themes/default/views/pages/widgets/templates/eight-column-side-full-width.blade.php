@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp

<div class="wrap-nrn" data-component='eight-column-side-full-width' style="{{ config('wizard.widget.every_div_style') }}">

    @include('pages.shared.home.editor')

    <div class="title bg-purple">
        <h4>{{ $title ?? '' }}</h4>
        @isset($category)
            <a href="{{ route('archive', ['slug' => $category]) }}" title="{{ $title ?? '' }}">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
        @endisset
    </div>

    <div class="row">
        <div class="col-6">
            @forelse ($data['posts'] as $post)
                @include('pages.widgets.templates.common.top-ad', [
                        'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
                    ])
                @if ($loop->first)

                    <div class="main-nrn hover-inner">
                        @if ($post->isThumbnailVisible())
                            @if ($post->image)
                                <div class="nrn-image hover-holder">
                                    <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="">
                                </div>
                            @endif
                        @endif
                        <div class="content">
                            <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
                            <p><span class="article-meta">
                        <span class="top-author-list"> {{ ucfirst($post->author_full_name) }} ,</span>{!! date_by_lang($post->created_at) !!} - </span>
                                {{ resolve_description($post->content, 400) }}
                            </p>
                        </div>
                    </div>

                    @break
                @endif
            @empty
            @endforelse
        </div>
        <div class="col-6">
            <div class="nrn-grid">
                @forelse ($data['posts'] as $post)
                    @if ($loop->iteration > 1)

                        <div class="nrn-item">
                            <h5><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h5>
                            @if ($post->isThumbnailVisible())
                                @if ($post->image)
                                    <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="{{ $post->title }}">
                                @endif
                            @endif
                            <div class="content">
                                <p>{{ resolve_description($post->content) }}</p>
                            </div>
                        </div>
                        <!-- /nrn item -->
                    @endif
                    @include('pages.widgets.templates.common.bottom-ad', [
                            'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
                        ])
                @empty
                @endforelse
            </div>
        </div>
    </div>

</div>
