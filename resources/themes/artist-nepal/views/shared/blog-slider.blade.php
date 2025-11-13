<section class="pr__blog pr__section section-slider uk-section uk-section-large" id="pr__blog">
    <div class="section-outer">
        <div class="section-heading pr__center">
            <div class="uk-container">
                <div class="inner">
                    <div class="center">
                        <h2 class="title uk-h1">Artist Blog</h2>
                        <span class="subtitle pr__heading__secondary">
                            informal help diary for using artist page
                        </span>
                    </div>
                </div>
            </div><!-- Container End -->
        </div><!-- Heading End -->
        <div class="section-inner">
            <div class="uk-container uk-container-no">
                <div class="blog-listing style-one blog-slider owl-carousel" data-items="4" data-loop="true"
                     data-center="true" data-margin="30" data-autoplay="true" data-dots="true">

                    @foreach($data['blogs'] as $blog)
                    <article class="post type-post">
                        <div class="outer">
                            <div class="featured-image">
                                <div class="image pr__image__cover"
                                     data-src="{{ $blog->getBanner() }}"
                                     data-uk-img=""></div>
                            </div>
                            <div class="inner">
                                <a class="category"
                                   href="{{ $blog->getFrontendUrl() }}">
                                    May 15, 2025
                                    {{ $blog->updated_at->format('F j, Y') }}
                                </a>
                                <h3 class="title uk-h5">
                                    <a href="{{ $blog->getFrontendUrl() }}">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <a href="{{ $blog->getFrontendUrl() }}"
                                   class="more icon pr-arrow-right"></a>
                                <a href="{{ $blog->getFrontendUrl() }}"
                                   class="link"></a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div><!-- Container End -->
        </div><!-- Inner End -->
    </div><!-- Outer End -->
</section>
