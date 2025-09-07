<div class="form-group row">
    <label class="col-sm-12 col-form-label">Facebook App Id <span class="required">*</span></label>
    <div class="col-sm-12">
        {!! Form::text('config[facebook_app_id]', $data['settings']['config']['facebook_app_id'] ?? null, ['class' => 'form-control','placeholder' => 'Facebook App ID', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('config.facebook_app_id'))
        <label class="error" for="config.facebook_app_id"> {{ $errors->first('config.facebook_app_id') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">
        ShareThis Property <span class="required">*</span>
        <span class="float-right"><a href="https://platform.sharethis.com/" target="_blank">Get Property ID ?</a></span>
    </label>
    <div class="col-sm-12">
        {!! Form::text('config[share_this_property]', $data['settings']['config']['share_this_property'] ?? null, ['class' => 'form-control','placeholder' => 'Enter the sharethis property', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('config.share_this_property'))
        <label class="error" for="config.share_this_property"> {{ $errors->first('config.share_this_property') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>
