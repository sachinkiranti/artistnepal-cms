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
        <label class="col-sm-12 col-form-label is_required">Ad URL <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('ad_url')?'has-error':'' }}">
            {!! Form::text('ad_url', null, [ 'class' => 'form-control', ]) !!}
            @if($errors->has('ad_url'))
                <label class="has-error" for="ad_url">{{ $errors->first('ad_url') }}</label>
            @endif
        </div>
    </div>
    <div class="hr-line-dashed"></div>

    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Type <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('type')?'has-error':'' }}">
            {!! Form::select('type', [ 'side' =>  'adv-side', 'full' => 'adv-full', ], null, [ 'class' => 'form-control', ]) !!}
            @if($errors->has('type'))
                <label class="has-error" for="type">{{ $errors->first('type') }}</label>
            @endif
        </div>
    </div>
    <div class="hr-line-dashed"></div>

    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Expired At <span class="required">*</span></label>
        <div class="col-sm-12 {{ $errors->has('expired_at')?'has-error':'' }}">
            {!! Form::date('expired_at', null, [ 'class' => 'form-control', ]) !!}
            @if($errors->has('expired_at'))
                <label class="has-error" for="expired_at">{{ $errors->first('expired_at') }}</label>
            @endif
        </div>
    </div>

    <div class="hr-line-dashed"></div>
    <div id="advertisement">
        <div class="input-group">
              <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail0" data-preview="file-manager-img-preview" class="btn btn-dark" style="color: #fff;">
                  <i class="fa fa-picture-o"></i> Choose
                </a>
              </span>
            <input id="thumbnail0" class="form-control" type="text" name="ad-image" value="{{ $widget->{'ad-image'} ?? '' }}">
        </div>

        <div id="file-manager-img-preview" style="margin-top:15px;max-height:100px;margin-bottom:15px;">
            @isset($widget->{'ad-image'})
            <img src="{{ $widget->{'ad-image'} ?? '' }}" style="height: 5rem;" class="img-responsive">
            @endisset
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
