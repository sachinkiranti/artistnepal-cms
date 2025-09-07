@if (count($data['related-posts']) > 0)

    <div class="related-news">
        <h3>{{ __('सम्बन्धित खबर') }}</h3>

        @forelse ($data['related-posts'] as $post)
            <div class="row related-news-item">
                <div class="cat_name col-2 leftSidebar">
                    <div class="catName nextNewsText">{{ $post->category_full_name ?? $post->category_name }}</div>

                    <ul class="writer-social-media">
                        <li><a href="#" title=""><i class="icon-fb"></i></a></li>
                        <li><a href="#" title=""><i class="icon-tw"></i></a></li>
                        <li><a href="#" title=""><i class="icon-go"></i></a></li>

                    </ul>
                </div>
                <div class="col-10">
                    <div class="article-header">
                        <h3><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></h3>
                        <div class="sub-headline">
                            {!! $post->secondary_title !!}
                        </div>
                    </div>
                    <div class="detail-meta">
                        <span class="author-name"> {{ $post->author_full_name }}</span>
                        <time>{!! date_by_lang($post->created_at) !!}</time>
                    </div>

                    <div class="description">
                        <p>
                            {!! resolve_description($post->content, 200) !!}
                        </p>
                    </div>
                    <a class="morelink" href="{{ route('post.single', $post->unique_identifier) }}"> {{ __('पूरा पढ्नुहोस्') }} &#8250;</a>
                </div>
            </div>
            <!-- /related-news-item -->
        @empty
        @endforelse
    </div>
@endif
