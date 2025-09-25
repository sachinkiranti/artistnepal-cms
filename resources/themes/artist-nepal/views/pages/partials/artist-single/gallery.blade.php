@if($data['profile']->galleries->isNotEmpty())
    <section class="pr__services pr__section uk-section">
        <div class="section-outer">
            <div class="section-heading">
                <div class="uk-container">
                    <div class="inner">
                        <div class="left">
                            <hr class="line pr__hr__secondary">
                            <h2 class="title uk-h1">Galleries</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-inner">
                <div class="uk-container">
                    <div class="gallery-wrap">
                        <div class="gallery-grid">
                            @foreach($data['profile']->galleries as $gallery)
                                <div class="grid-item">
                                    <a href="{{ $gallery->getImage() }}"
                                       data-fancybox="gallery">
                                        <img
                                            src="{{ $gallery->getImage() }}"
                                            style="width: 100%">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
