@php
    extract($data['widget']);
@endphp

@include('pages.shared.home.editor')

<div data-component="html" class="social-media" style="{{ config('wizard.widget.every_div_style') }}">
    @if(!empty($title))
        <h4 class="social-title bg-red" style="color: #FFF;"><i class="icon-twitter"></i> {{ $title ?? '' }}</h4>
    @endif
    {!! $description !!}
</div>
