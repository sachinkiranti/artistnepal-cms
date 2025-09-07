<input type="hidden" name="identifier" value="{{ $identifier }}">
<input type="hidden" name="widget_id" value="{{ $widgetId }}">
<input type="hidden" name="component" value="{{ $component }}">

@if ($action !== 'edit')
    @includeIf('admin.appearance.customizer.widgets.partials.action')
@endif

{!! app('form')->close() !!}
