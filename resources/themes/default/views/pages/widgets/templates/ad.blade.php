@include('pages.shared.home.editor')

@if(!is_null(array_get($data ,'widget.advertisement')) && !empty(array_get($data ,'widget.advertisement')))
<div class="adv {{ array_get($data ,'widget.type') ?? 'adv-full' }} ad-wrapper" data-identifier="{{ array_get($data, 'widget.id') }}">
    <a href="{{ array_get($data, 'widget.url') ?? url('/') }}" title="{{ array_get($data ,'widget.title') }}">
        <img class="lazy" data-src="{{ array_get($data ,'widget.advertisement') }}" alt="{{ array_get($data ,'widget.title') }}">
    </a>
</div>
@endif
