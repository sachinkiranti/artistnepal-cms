<div class="form-group  row">
    <label class="col-sm-12 col-form-label">Homepage Modal Ads</label>
    <div class="col-sm-12">

        <div class="col-sm-12">
            <div class="i-checks">
                <label style="cursor: pointer;">{!! Form::checkbox('is_homepage_popup_ads_enabled', null, $data['settings']['is_homepage_popup_ads_enabled'] ?? null, [ 'class' => 'i-checks-checkbox', ]) !!} Enable The popup advertisement  </label>
            </div>
        </div>

        @if($errors->has('homepage_popup_ads_holder'))
            <label class="has-error" for="available_seat">{{ $errors->first('homepage_popup_ads_holder') }}</label>
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

        {!! Form::file('homepage_popup_ads_holder', isset($data['settings']['homepage_popup_ads'])?array_merge($file,
           ['data-default-file' => url('storage/images/setting/'.$data['settings']['homepage_popup_ads'])]):$file)
           !!}


    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">Home page ads url</label>
    <div class="col-sm-12">
        {!! Form::text('homepage_popup_ads_url',$data['settings']['homepage_popup_ads_url'] ?? null, ['class' => 'form-control','placeholder' => 'Enter the url', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('homepage_popup_ads_url'))
        <label class="error" for="homepage_popup_ads_url"> {{ $errors->first('homepage_popup_ads_url') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>

<div class="hr-line-dashed"></div>

<div class="form-group  row">
    <label class="col-sm-12 col-form-label">News Detail Page</label>

    <div class="col-sm-12">
        <div class="i-checks">
            <label style="cursor: pointer;">{!! Form::checkbox('is_single_page_popup_ads_enabled', null, $data['settings']['is_single_page_popup_ads_enabled'] ?? null, [ 'class' => 'i-checks-checkbox', ]) !!} Enable The advertisement  </label>
        </div>
    </div>
    <div class="col-sm-12">

        @if($errors->has('single_page_ads_holder'))
            <label class="has-error" for="available_seat">{{ $errors->first('single_page_ads_holder') }}</label>
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

        {!! Form::file('single_page_ads_holder', isset($data['settings']['single_page_popup_ads'])?array_merge($file,
           ['data-default-file' => url('storage/images/setting/'.$data['settings']['single_page_popup_ads'])]):$file)
           !!}


    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label">Single page ads url</label>
    <div class="col-sm-12">
        {!! Form::text('single_page_ads_url',$data['settings']['single_page_ads_url'] ?? null, ['class' => 'form-control','placeholder' => 'Enter the url', 'autocomplete' => 'off']) !!}
    </div>
    @if($errors->has('single_page_ads_url'))
        <label class="error" for="single_page_ads_url"> {{ $errors->first('single_page_ads_url') }}</label>
    @endif
</div>
<div class="hr-line-dashed"></div>
