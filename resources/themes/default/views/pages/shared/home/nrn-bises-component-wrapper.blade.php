<div class="nrn-bises-wrapper" data-component-wrapper="{{ active_lang() == 'np' ? '' : 'en-' }}nrn-bises-component-wrapper">
    <div class="container">

        <div class="nrn-bises">
            <div class="row">
                <div class="col-8">
                    {!! $components[(active_lang() == 'np' ? '' : 'en-').'eight-section-component'] ?? '' !!}
                </div>
                <div class="col-4">
                    {!! $components[(active_lang() == 'np' ? '' : 'en-').'four-section-component'] ?? '' !!}
                </div>
            </div>
        </div>

    </div>
</div>
