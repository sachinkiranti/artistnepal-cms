@if (\Foundation\Builders\Cache\Meta::get('is_homepage_popup_ads_enabled'))
<div class="modal inmodal" id="pop-up-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span> Skip
                </button>
            </div>
            <div class="modal-body">
                <a href="{{ \Foundation\Builders\Cache\Meta::get('homepage_popup_ads_url') ?? 'javascript:void(0)' }}">
                    <img src="{{ asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('homepage_popup_ads')) }}" alt="">
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ theme_asset('js/bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $("#pop-up-modal").modal({backdrop: "static"});
        })
    </script>
@endpush
@endif
