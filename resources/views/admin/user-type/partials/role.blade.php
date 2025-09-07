<div class="hr-line-dashed"></div>
<div class="form-group">
    <label for="roles">Role <span class="required">*</span></label>

    {!! Form::select('roles[]',$data['roles'], null, [ 'class' => 'form-control select2_role', 'multiple' =>'multiple']) !!}
    @if($errors->has('roles'))
        <label class="has-error" for="roles">{{ $errors->first('roles') }}</label>
    @endif
</div>
