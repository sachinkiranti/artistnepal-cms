<section class="pr__services pr__section uk-section uk-section-large" id="pr__services">
    <div class="section-outer">
        <div class="section-heading">
            <div class="uk-container">
                <div class="inner">
                    <div class="left">
                        <hr class="line pr__hr__secondary">
                        <h2 class="title uk-h1">Services.</h2>
                        <span class="subtitle pr__heading__secondary">We work with you, Not for you</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-inner">
            <div class="uk-container">
                <div
                    class="items-listing services-boxes uk-grid uk-grid-match uk-grid-medium uk-child-width-1-3@m uk-child-width-1-2@s"
                    data-uk-grid="">

                    @foreach($data['categories'] as $category)
                    <div class="item service-box style-one ">
                        <div class="inner">
                            <i class="overlay-icon icon pr-line-target"></i>
                            <h5 class="title uk-h5">{{ ucwords($category->category_name) }}</h5>
                            <i class="icon pr-arrow-right"></i>
                            <a href="{{ route('listing') }}?category[]={{ $category->id }}"
                               class="link uk-position-cover"></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
