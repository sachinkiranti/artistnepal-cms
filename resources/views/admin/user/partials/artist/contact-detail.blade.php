<div role="tabpanel" id="tab-contact-detail" class="tab-pane">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <label class=" col-form-label is_required">
                    <b>Telephone <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('telephone')?'has-error':'' }}">
                    {!! Form::text('telephone', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('telephone'))
                        <label class="has-error" for="telephone">{{ $errors->first('telephone') }}</label>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <label class=" col-form-label is_required">
                    <b>Mobile <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('mobile')?'has-error':'' }}">
                    {!! Form::text('mobile', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('mobile'))
                        <label class="has-error" for="mobile">{{ $errors->first('mobile') }}</label>
                    @endif
                </div>
            </div>
        </div>

        <div class="hr-line-dashed"></div>

        <div class="row">
            <div class="col-sm-12">
                <label class=" col-form-label is_required">
                    <b>Email Address <span class="required">*</span></b>
                </label>
                <div class=" {{ $errors->has('email_address')?'has-error':'' }}">
                    {!! Form::email('email_address', null, [ 'class' => 'form-control', ]) !!}
                    @if($errors->has('email_address'))
                        <label class="has-error" for="email_address">{{ $errors->first('email_address') }}</label>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
