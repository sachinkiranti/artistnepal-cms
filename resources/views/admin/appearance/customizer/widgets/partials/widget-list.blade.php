<div class="widget-show">
    <div class="hr-line-dashed"></div>

    <div class="widget-{{ $key }}" data-widget="{{ $key }}" data-template="{{ $widget->template ?? '' }}" data-component="{{ $widget->component }}">
        <div class="widget-{{ $key }}-wrapper">
            <b>{{ ucwords($widget->title) }}</b> <code class="pull-right" title="Widget">{{ ucwords(str_replace(['-', '-',], ' ', $widget->identifier)) }}</code><br>

            @if ($widget->identifier !== 'html' && isset($widget->description))
                <b><small>{{ \Illuminate\Support\Str::limit($widget->description, 50, '...') }}</small></b>
            @endif
            <div class="hr-line-dashed"></div>

            <span>
                <button title="Add Advertisement" class="btn btn-primary btn-xs add-advertisement" data-identifier="{{ $widget->identifier }}" data-widget="{{ $widget->widget_id }}" data-component="{{ $widget->component }}"> <i class="fa fa-money"></i> </button>
                <button title="Edit Widget" class="btn btn-dark btn-xs edit-widget" data-identifier="{{ $widget->identifier }}" data-widget="{{ $widget->widget_id }}" data-component="{{ $widget->component }}"> <i class="fa fa-edit"></i> </button>
                <button title="Delete Widget" class="btn btn-danger btn-xs delete-widget" data-widget="{{ $widget->widget_id }}" data-component="{{ $widget->component }}"> <i class="fa fa-trash-o"></i> </button>
            </span>
        </div>
    </div>
</div>
