@isset($data['post']->user, $data['post']->user->posts)
    <div class="news-writer" style="width: 100%;margin-top: 30px;">
        <div class="writer-media">
            <div class="writer-pic">
                <img src="{{ $data['post']->user->getImage() }}"
                     alt="{{ $data['post']->author ?? $data['post']->author_full_name }}">
            </div>

            <ul class="writer-social-media">
                @isset ($data['post']->user->meta['facebook'])
                    <li>
                        <a href="{{ $data['post']->user->meta['facebook'] }}" target="_blank" title="facebook">
                            <i class="icon-fb"></i>
                        </a>
                    </li>
                @endisset
                @isset($data['post']->user->meta['twitter'])
                    <li>
                        <a href="{{ $data['post']->user->meta['twitter'] }}" target="_blank" title="twitter">
                            <i class="icon-tw"></i>
                        </a>
                    </li>
                @endisset
                @isset($data['post']->user->meta['google'])
                    <li>
                        <a href="{{ $data['post']->user->meta['google'] }}" target="_blank" title="googleplus">
                            <i class="icon-go"></i>
                        </a>
                    </li>
                @endisset
            </ul>
        </div>
        <div class="writer-news">
            <p><strong>{{ ucfirst($data['post']->author ?? $data['post']->author_full_name) }}</strong> - {{ $data['post']->user->meta['description'] ?? '' }}</p>

            <ul class="writer-news-list" id="writer-news">
            @forelse ($data['post']->user->posts as $post)
                    <li><a href="{{ route('post.single', $post->unique_identifier) }}" title="{{ $post->title }}">{{ $post->title }}</a></li>
            @empty
            @endforelse
            </ul>

            <a href="javascript:void(0)" id="read-more-news-writer" class="thap">थप <span>&#187;</span></a>
        </div>
    </div>
@endisset
