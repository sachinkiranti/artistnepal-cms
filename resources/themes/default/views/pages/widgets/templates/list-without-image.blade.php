@php
    extract($data['widget']);

    if (isset($advertisement) && isset($advertisement->top) && isset($advertisement->bottom)) {
        $topAdvertisements    = $advertisement->top;
        $bottomAdvertisements = $advertisement->bottom;
    }
@endphp
<div data-component="list-without-image" class="card-news" style="{{ config('wizard.widget.every_div_style') }}">

    @include('pages.shared.home.editor')

    <div class="title bg-red">
        <h4>{{ $title }}</h4>
    </div>
    <!-- /title -->

    @forelse ($data['posts'] as $post)
        @include('pages.widgets.templates.common.top-ad', [
                'topAdvertisements' => $topAdvertisements ?? $advertisement[$loop->index]->top ?? []
            ])
        <div class="card-item">
            <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
            <p><span class="article-meta"><span class="top-author-list"> {{ ucfirst($post->author_full_name) }}</span> {!! date_by_lang($post->created_at) !!}</span></p>
        </div>
        <!-- /card -->
        @include('pages.widgets.templates.common.bottom-ad', [
                'bottomAdvertisements' => $bottomAdvertisements ?? $advertisement[$loop->index]->bottom ?? []
            ])
    @empty
    @endforelse

</div>
<!-- /card news -->

