<div class="form-group row">
    <label class="col-sm-12 col-form-label">Site Name <span class="required">*</span></label>
    <div class="col-sm-12">
        {!! Form::text('company',$data['settings']['company'] ?? null, ['class' => 'form-control','placeholder' => 'Company', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('company'))
        <label class="error" for="company"> {{ $errors->first('company') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Site Logo <span class="required">*</span></label>
    <div class="col-sm-12">

        @if($errors->has('photo'))
            <label class="has-error" for="available_seat">{{ $errors->first('photo') }}</label>
        @endif
        @php($file = [
            'id' => 'image_path',
            'class' => 'form-control dropify img-responsive',
            'data-plugin' => 'dropify',
            'data-height' => '200',
            'data-show-remove'=>'false',
            'data-allowed-file-extensions'=>'pdf png psd jpeg jpg gif',
            'data-disable-remove'=> 'true',
            'data-max-file-size' => '2M',
        ])

        {!! Form::file('photo', isset($data['settings']['logo'])?array_merge($file,
           ['data-default-file' => url('storage/images/setting/'.$data['settings']['logo'])]):$file)
           !!}


    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Default Site Banner <span class="required">*</span></label>
    <div class="col-sm-12">

        @if($errors->has('default_banner_holder'))
            <label class="has-error" for="available_seat">{{ $errors->first('default_banner_holder') }}</label>
        @endif
        @php($file = [
            'id' => 'image_path',
            'class' => 'form-control dropify img-responsive',
            'data-plugin' => 'dropify',
            'data-height' => '200',
            'data-show-remove'=>'false',
            'data-allowed-file-extensions'=>'pdf png psd jpeg jpg gif',
            'data-disable-remove'=> 'true',
            'data-max-file-size' => '2M',
        ])

        {!! Form::file('default_banner_holder', isset($data['settings']['default_banner'])?array_merge($file,
           ['data-default-file' => url('storage/images/setting/'.$data['settings']['default_banner'])]):$file)
           !!}


    </div>
</div>

<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Domain</label>
    <div class="col-sm-12">
        {!! Form::url('domain',$data['settings']['domain'] ?? null, ['class' => 'form-control','placeholder' => 'Domain', 'autocomplete' => 'off']) !!}

    </div>
    @if($errors->has('domain'))
        <label class="error" for="domain"> {{ $errors->first('domain') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">Email</label>
    <div class="col-sm-12">
        {!! Form::email('email',$data['settings']['email'] ?? null, ['class' => 'form-control','placeholder' => 'Email', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('email'))
        <label class="error" for="email"> {{ $errors->first('email') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">USA Email</label>
    <div class="col-sm-12">
        {!! Form::email('usa_email',$data['settings']['usa_email'] ?? null, ['class' => 'form-control','placeholder' => 'Email', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('usa_email'))
        <label class="error" for="usa_email"> {{ $errors->first('usa_email') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">Company Location</label>
    <div class="col-sm-12">
        {!! Form::text('location',$data['settings']['location'] ?? null, ['class' => 'form-control ','placeholder' => 'Location', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('location'))
        <label class="error" for="location"> {{ $errors->first('location') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">Secondary Company Location</label>
    <div class="col-sm-12">
        {!! Form::text('secondary_location',$data['settings']['secondary_location'] ?? null, ['class' => 'form-control ','placeholder' => 'Location', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('secondary_location'))
        <label class="error" for="secondary_location"> {{ $errors->first('secondary_location') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">USA Phone No.</label>
    <div class="col-sm-12">
        {!! Form::text('mobile',$data['settings']['mobile'] ?? null, ['class' => 'form-control ','placeholder' => 'Mobile', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('mobile'))
        <label class="error" for="mobile"> {{ $errors->first('mobile') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">Nepal Phone No.</label>
    <div class="col-sm-12">
        {!! Form::text('phone',$data['settings']['phone'] ?? null, ['class' => 'form-control','placeholder' => 'Phone', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('phone'))
        <label class="error" for="phone"> {{ $errors->first('phone') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Copyright</label>
    <div class="col-sm-12">
        {!! Form::text('copyright-text',$data['settings']['copyright-text'] ?? null, ['class' => 'form-control','placeholder' => 'Copyright © 2020 CMS. All Rights Reserved.', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('copyright-text'))
        <label class="error" for="copyright-text"> {{ $errors->first('copyright-text') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>
