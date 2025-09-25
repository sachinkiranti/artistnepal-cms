@if($data['similar-artists']->isNotEmpty())
<section class="pr__blog pr__section section-slider uk-section uk-section-xsmall uk-section-default" id="pr__blog">
    <div class="section-outer">
        <div class="section-heading">
            <div class="uk-container">
                <div class="inner">
                    <div>
                        <hr class="line pr__hr__secondary">
                        <h2 class="title uk-h3 pr__heading__secondary">Similar Artists.</h2>
                    </div>
                </div>
            </div><!-- Container End -->
        </div><!-- Heading End -->
        <div class="section-inner">
            <div class="uk-container">
                <div class="blog-listing style-two blog-slider uk-grid uk-grid-collapse uk-child-width-1-3@m"
                     data-uk-grid="">
                    @foreach($data['similar-artists'] as $similarArtist)

                        <div class="item">
                            <article class="post type-post ">
                                <div class="outer">
                                    <div class="featured-image">
                                        <div class="image pr__image__cover"
                                             data-src="{{ $similarArtist?->user?->getImage() }}"
                                             data-uk-img=""></div>
                                    </div>
                                    <div class="inner">
                                        <div class="top">
                                            <a class="category" href="#"></a>
                                            <h3 class="title uk-h4"><a href="#">{{ $similarArtist?->user?->getFullname() ?? 'Unidentified' }}</a></h3>
                                            <p class="description">
                                                {{ \Illuminate\Support\Str::limit(trim(html_entity_decode(strip_tags($similarArtist->bio))), 100)  }}
                                            </p>
                                            <a href="{{ route('artist.single', $similarArtist?->user?->unique_identifier) }}" class="link"></a>
                                        </div>
                                        <div class="bottom">
                                            <ul class="meta">
                                                <li class="meta-date">{{ ucwords($data['category']->category_name) }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                    @endforeach
                </div>
            </div><!-- Container End -->
        </div><!-- Inner End -->
    </div><!-- Outer End -->
</section>
@endif
