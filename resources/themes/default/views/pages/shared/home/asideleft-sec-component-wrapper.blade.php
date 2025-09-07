<div class="container-fluid nrn-wrap" data-component-wrapper="{{ active_lang() == 'np' ? '' : 'en-' }}asideleft-sec-component-wrapper">
    <div class="container">
        <section class="asideleft-sec">
            <div class="row">
                <div class="col-8">
                    {!! $components[(active_lang() == 'np' ? '' : 'en-').'footer-eight-section-component'] ?? ''!!}
                </div>
                <div class="col-4 border-left">
                    {!! $components[(active_lang() == 'np' ? '' : 'en-').'footer-four-section-component'] ?? ''!!}
                </div>
            </div>
        </section>
    </div>
</div>
