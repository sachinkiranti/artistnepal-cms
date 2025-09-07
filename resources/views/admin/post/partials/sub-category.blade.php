<div class="sub-category">
    <div class="hr-line-dashed"></div>
    <div class="form-group row">
        <label class="col-sm-12 col-form-label is_required">Sub Category <span class="required">*</span> </label>
        <div class="col-sm-12 {{ $errors->has('sub-category') ? 'has-error' : '' }}">
            {!! Form::select('sub-category', $subCategory, $childCategory ?? null, [ 'class' => 'form-control subCategory-select', ]) !!}
            @if($errors->has('sub-category'))
                <label class="has-error" for="sub-category">{{ $errors->first('sub-category') }}</label>
            @endif
        </div>
    </div>
</div>
