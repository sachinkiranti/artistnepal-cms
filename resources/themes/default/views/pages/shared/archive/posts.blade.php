@forelse ($data['posts'] as $post)
    <div class="cat-box hover-inner posts-loaded">
        @if ($post->image)
        <div class="cat-img hover-holder">
            <a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">
                <img src="{{ resolve_image($post->image, $post->unique_identifier) }}" alt="{{ $post->title }}"></a>
        </div>
        @endif
        <div class="cat-docs" style="@if(is_null($post->image))width: calc(100%)!important;@endif">
            <h4><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h4>
            <p><span class="article-meta">
                    <span class="top-author-list"> {{ ucfirst($post->author_full_name) }} ,</span>
                    {!! date_by_lang($post->created_at) !!} - </span>
                {!! resolve_description($post->content, 200) !!}
            </p>
        </div>
    </div>
    <!-- /cat box -->
@empty
    <p>{{ __('Post not found !') }}</p>
@endforelse
