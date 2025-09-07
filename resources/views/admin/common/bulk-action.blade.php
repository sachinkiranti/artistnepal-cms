<div class="btn-group form-inline" id="bulk-action">

    @include('admin.common.checkbox', [
            'name' => 'parent-checkbox[]',
            'id'   => 'parent-checkbox',
        ])

    {!! Form::open([ 'url' => null, 'id' => 'bulk-action-form', 'method' => 'POST', ]) !!}
        {!! Form::Hidden('ids', null, [ 'id' => 'ids', ]) !!}
    {!! Form::close() !!}
</div>
