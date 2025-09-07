@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
<div data-component="list-with-one-full-image" class="entertainment-wrap" style="{{ config('wizard.widget.every_div_style') }}">
    @include('pages.shared.home.editor')

    <div class="title bg-orange">
        <h4>{{ $title ?? '' }}</h4>
        @isset($category)
        <a href="{{ route('archive', ['slug' => $category]) }}" title="">{{ __(active_lang() == 'en' ? 'All :' : 'सबै :') }}</a>
        @endisset
    </div>
    <!-- /title -->
    <div class="row">
        <div class="col-12">
            @forelse ($data['posts'] as $post)

                @include('pages.widgets.templates.common.top-ad', [
                    'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
                ])

                @if ($loop->first)
                    <div class="main-enter hover-inner">
                        @if ($post->isThumbnailVisible())
                            @if ($post->image)
                                <div class="hover-holder">
                                    <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" alt="{{ $post->title }}">
                                </div>
                            @endif
                        @endif
                        <div class="enter-content">
                            <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
                        </div>
                    </div>
                @endif

            @include('pages.widgets.templates.common.bottom-ad', [
                'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
            ])

        @empty
        @endforelse
        <!-- / -->
        </div>
        <!-- /col -->

        @forelse ($data['posts'] as $post)
{{--            @include('pages.widgets.templates.common.top-ad', [--}}
{{--                'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []--}}
{{--            ])--}}
            @if ($loop->iteration > 1)
            <div class="col-6">

                        <div class="enter-item">
                            @if ($post->isThumbnailVisible())
                                @if ($post->image)
                                    <img class="lazy" data-src="{{ get_thumbnail( $post->image, $post->unique_identifier ) }}" alt="{{ $post->title }}">
                                @endif
                            @endif
                            <div class="content">
                                <h5><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h5>

                                <p>{{ resolve_description($post->content, 200) }}</p>
                            </div>
                        </div>
                        <!-- /item -->
            </div>
            @endif
{{--            @include('pages.widgets.templates.common.bottom-ad', [--}}
{{--                'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []--}}
{{--            ])--}}
        @empty
        @endforelse
        <!-- /col -->

    </div>
</div>
