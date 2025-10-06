<div class="gallery-wrap-inset">
    <div class="gallery-grid">
        @foreach($data['featured-artists'] as $featuredArtist)
        <a href="{{ $featuredArtist->getArtistFrontendUrl() }}" class="grid-item grid-item--small">

            <div class="item gallery-box small">
                <div class="outer">
                    <div class="image pr__image__cover" style="padding-top: 0 !important;">
                        <img src="{{ $featuredArtist->getImage() }}" alt="{{ $featuredArtist->full_name }}">
                    </div>
                    <div class="inner">
                        <h3 class="title uk-h5">{{ $featuredArtist->full_name }}</h3>
                        <p class="description">fashion &amp; glamour/ Model/ Promotional Model/ Runway Model
                        </p>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>


