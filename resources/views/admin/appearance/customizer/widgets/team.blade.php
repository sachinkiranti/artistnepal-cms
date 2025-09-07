@include('admin.appearance.customizer.widgets.partials.widget-top', [
    'widgetId'    => $widgetId ?? 'undefined',
    'identifier'  => $identifier ?? 'undefined',
    'component'   => $component ?? 'undefined',
    'action'      => $action ?? 'store',
    'widget'      => $widget ?? [],
    'widgetClass' => $widgetClass ?? 'unfold-widget'
])

    <div class="hr-line-dashed"></div>
    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Title <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('title')?'has-error':'' }}">
            {!! Form::text('title', null, [ 'class' => 'form-control', ]) !!}
            @if($errors->has('title'))
                <label class="has-error" for="title">{{ $errors->first('title') }}</label>
            @endif
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Description <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('description')?'has-error':'' }}">
            {!! Form::textarea('description', null, [ 'class' => 'form-control', 'rows' => 3, ]) !!}
            @if($errors->has('description'))
                <label class="has-error" for="description">{{ $errors->first('description') }}</label>
            @endif
        </div>
    </div>
    <div class="hr-line-dashed"></div>

@include('admin.appearance.customizer.widgets.partials.widget-footer', [
    'widgetId'    => $widgetId ?? 'undefined',
    'identifier'  => $identifier ?? 'undefined',
    'component'   => $component ?? 'undefined',
    'action'      => $action ?? 'store',
    'widget'      => $widget ?? [],
    'widgetClass' => $widgetClass ?? 'unfold-widget'
])
