@if ($action == 'store')
    {!!
         app('form')->open([
             'route'   => 'admin.save.widget',
             'method'  => 'post',
             'enctype' => 'multipart/form-data',
             'id'      => "form",
             'class'   => $widgetClass ?? 'unfold-widget'
         ])
    !!}

@else

    {!!
        app('form')->model($widget, [
            'enctype' => 'multipart/form-data',
            'route'   => [ 'admin.update.widget', $widget->widget_id],
            'method'  => 'PATCH',
            'role'    => 'form'
        ]);
    !!}

@endif

@if ($action !== 'edit')
    <div class="hr-line-dashed"></div>
    <b><i class="fa fa-windows" aria-hidden="true"></i> {{ ucwords(str_replace([ '-', '_', ], ' ', $identifier)) }}</b>
@endif
