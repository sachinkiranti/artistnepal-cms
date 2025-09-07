<div class="container" data-component-wrapper="{{ active_lang() == 'np' ? '' : 'en-' }}page-sidebar-component-wrapper">
    {!! $components[(active_lang() == 'np' ? '' : 'en-').'page-sidebar-component'] ?? '' !!}
</div>
