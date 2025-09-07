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
            {!! Form::text('title', null, [ 'class' => 'form-control', 'placeholder' => 'Enter title for the widget', ]) !!}
            @if($errors->has('title'))
                <label class="has-error" for="title">{{ $errors->first('title') }}</label>
            @endif
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Category <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('category')?'has-error':'' }}">
            {!! Form::select('category', $categories, null, array_merge([ 'class' => 'form-control', 'placeholder' => 'Select Category', ])) !!}
            @if($errors->has('category'))
                <label class="has-error" for="category">{{ $errors->first('category') }}</label>
            @endif
        </div>
    </div>
    <div class="hr-line-dashed"></div>

    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Select template for the widget <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('template')?'has-error':'' }}">
            {!! Form::select('template', $templates, null, [ 'template_name' => optional($widget ?? '')->template  ?? '', 'class' => 'form-control', 'placeholder' => 'Select Template', ]) !!}
            @if($errors->has('template'))
                <label class="has-error" for="template">{{ $errors->first('template') }}</label>
            @endif

            <div class="widget-previewer" style="display: none;">
                <div class="widget-image">
                    <div class="hr-line-dashed"></div>
                    <h1 class="loading-images">Loading ....</h1>
                    <img src="{{ theme_asset('img/no-preview.jpeg') }}" alt="Widget Preview" class="img-responsive widget-preview-thumbnail" style="display: block;margin-left: auto;margin-right: auto;max-width: 50%;">
                </div>
            </div>
        </div>
    </div>

    <div class="show-total-rectangle-input-wrapper" style="display: {{ isset($showTotalRectanglePost) && $showTotalRectanglePost ? 'block' : 'none' }}">
        <div class="hr-line-dashed"></div>
        <div class="form-group row">
            <label class="col-sm-12 col-form-label is_required">No. of Rectangle Image <span class="required">*</span></label>
            <div class="col-sm-12 {{ $errors->has('no_of_rectangle_image')?'has-error':'' }}">
                {!! Form::number('no_of_rectangle_image', null, [ 'class' => 'form-control', 'placeholder' => 'Enter no of rectange image', ]) !!}
                @if($errors->has('no_of_rectangle_image'))
                    <label class="has-error" for="no_of_rectangle_image">{{ $errors->first('no_of_rectangle_image') }}</label>
                @endif
            </div>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">No Of Post to Display <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('limit')?'has-error':'' }}">
            {!! Form::select('limit', $limits, null, [ 'class' => 'form-control', 'placeholder' => 'Select Limit', ]) !!}
            @if($errors->has('limit'))
                <label class="has-error" for="limit">{{ $errors->first('limit') }}</label>
            @endif
        </div>
    </div>

    <div class="hr-line-dashed"></div>
    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Description <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('description')?'has-error':'' }}">
            {!! Form::textarea('description', null, [ 'class' => 'form-control', 'rows' => 3, 'placeholder' => 'Enter Description', ]) !!}
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
