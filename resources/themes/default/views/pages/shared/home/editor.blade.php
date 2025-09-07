@if (request()->is('customizer') || request()->routeIs('post.single.customizer'))
    <button class="button-editor edit-component-wrapper edit-widget" title="Edit widget" data-identifier="{{ array_get($data, 'widget-identifier') }}" data-widget="{{ array_get($data, 'widget.id') }}" data-component="{{ $data['component'] ?? '' }}"><i class="material-icons">create</i></button> &nbsp;&nbsp;
    <button class="button-editor widget-ads-editor edit-component-wrapper add-advertisement" title="Edit Advertisement" data-identifier="{{ array_get($data, 'widget-identifier') }}" data-widget="{{ array_get($data, 'widget.id') }}" data-component="{{ $data['component'] ?? '' }}"><i class="material-icons">spellcheck</i></button>
@endif
