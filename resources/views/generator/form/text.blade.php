<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">input</label>
    <div class="col-sm-6 {{ $errors->has('input') ? 'has-error' : '' }}">
        {!! Form::text('input', null, [ 'class' => 'form-control' ]) !!}
        @if($errors->has('input'))
            <label class="has-error" for="input">{{ $errors->first('input') }}</label>
        @endif
    </div>
</div>
