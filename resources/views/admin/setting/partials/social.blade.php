<div class="form-group row">
    <label class="col-sm-12 col-form-label">Facebook</label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group addon">
                <span class="input-group-addon"><i class="fa fa-facebook-f"></i></span>
                {!! Form::url('social[facebook]', $data['settings']['social']['facebook'] ?? null, ['class' => 'form-control','placeholder' => 'Enter Facebook Page Url', 'autocomplete' => 'off']) !!}
            </div>
        </div>
    </div>
    @if($errors->has('social.facebook'))
        <label class="error" for="company"> {{ $errors->first('social.facebook') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Twitter</label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group addon">
                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                {!! Form::url('social[twitter]', $data['settings']['social']['twitter'] ?? null, ['class' => 'form-control','placeholder' => 'Enter Twitter Page Url', 'autocomplete' => 'off']) !!}
            </div>
        </div>
    </div>
    @if($errors->has('social.twitter'))
        <label class="error" for="company"> {{ $errors->first('social.twitter') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Skype</label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group addon">
                <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                {!! Form::text('social[skype]', $data['settings']['social']['skype'] ?? null, ['class' => 'form-control','placeholder' => 'Enter skype username', 'autocomplete' => 'off']) !!}
            </div>
        </div>
    </div>
    @if($errors->has('social.skype'))
        <label class="error" for="company"> {{ $errors->first('social.skype') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Youtube</label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group addon">
                <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>
                {!! Form::url('social[youtube]', $data['settings']['social']['youtube'] ?? null, ['class' => 'form-control','placeholder' => 'Enter youtube username', 'autocomplete' => 'off']) !!}
            </div>
        </div>
    </div>
    @if($errors->has('social.youtube'))
        <label class="error" for="company"> {{ $errors->first('social.youtube') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="form-group row">
    <label class="col-sm-12 col-form-label">Instagram</label>
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group addon">
                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                {!! Form::url('social[instagram]', $data['settings']['social']['instagram'] ?? null, ['class' => 'form-control','placeholder' => 'Enter instagram', 'autocomplete' => 'off']) !!}
            </div>
        </div>
    </div>
    @if($errors->has('social.instagram'))
        <label class="error" for="company"> {{ $errors->first('social.instagram') }}</label>
    @endif
</div>

<div class="hr-line-dashed"></div>

<div class="form-group row">
    <div class="col-sm-12">

        @if($errors->has('social_homepage'))
            <label class="has-error" for="social_homepage">{{ $errors->first('social_homepage') }}</label>
        @endif
        @php($file = [
            'id' => 'image_path',
            'class' => 'form-control dropify-social-homepage img-responsive',
            'data-plugin' => 'dropify',
            'data-height' => '200',
            'data-show-remove'=>'false',
            'data-allowed-file-extensions'=>'pdf png psd jpeg jpg gif',
            'data-disable-remove'=> 'true',
            'data-max-file-size' => '2M',
        ])

        {!! Form::file('social_homepage', isset($data['settings']['social_homepage_image'])?array_merge($file,
           ['data-default-file' => url('storage/images/setting/'.$data['settings']['social_homepage_image'])]):$file)
           !!}


    </div>
</div>

<div class="hr-line-dashed"></div>
