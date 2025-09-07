@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp

@include('pages.shared.home.editor')

<div class="title bg-green">
    <h4>{{ $title ?? '' }} </h4>
    <a href="{{ route('archive', ['slug' => $category]) }}" title="{{ $title ?? '' }}">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
</div>
<!-- /title -->

<div data-component="eight-column-top-full-width" class="row" style="{{ config('wizard.widget.every_div_style') }}">
    @forelse ($data['posts'] as $post)

        @include('pages.widgets.templates.common.top-ad', [
                'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
            ])

        <div class="col-6">
            <div class="bichar">
                <div class="bichar-head">
                    @if ($post->isThumbnailVisible())
                        @if ($post->image)
                            <div class="bichar-media">
                                <img class="lazy" data-src="{{ get_thumbnail($post->image, $post->unique_identifier) }}" alt="">
                            </div>
                        @endif
                    @endif
                    <div class="bichar-title">
                        <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
                        <span class="article-meta"><span class="top-author-list"> {{ ucfirst($post->author_full_name) }}</span>{!! date_by_lang($post->created_at) !!} - </span>
                    </div>

                </div>
                <p>{{ resolve_description($post->content, 200) }}</p>
            </div>
        </div>
        <!-- /col -->

        @include('pages.widgets.templates.common.bottom-ad', [
            'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
        ])

        @empty
        @endforelse
        </div>
        <!-- /row -->
