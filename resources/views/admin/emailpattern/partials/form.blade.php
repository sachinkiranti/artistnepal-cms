<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">name</label>
    <div class="col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::text('name', null, [ 'class' => 'form-control' ]) !!}
        @if($errors->has('name'))
            <label class="has-error" for="name">{{ $errors->first('name') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">slug</label>
    <div class="col-sm-6 {{ $errors->has('slug') ? 'has-error' : '' }}">
        {!! Form::text('slug', null, [ 'class' => 'form-control' ]) !!}
        @if($errors->has('slug'))
            <label class="has-error" for="slug">{{ $errors->first('slug') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-1 col-form-label is_required">status</label>
    <div class="col-sm-8">
        <div class="i-checks mt-2">
            <label for="active"> {!! Form::radio('status', 1, true, ['id' => 'active']) !!} <i></i> Active </label>
            <label for="inactive"> {!! Form::radio('status', 0, false, ['id' => 'inactive']) !!} <i></i> Inactive </label>
        </div>
    </div>
</div>

