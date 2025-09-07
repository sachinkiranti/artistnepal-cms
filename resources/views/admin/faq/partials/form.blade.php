@include('admin.common.language-input', [ 'language' => $data['faq']->lang ?? null ])

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-12 col-form-label is_required">Faq Name <span class="required">*</span></label>
    <div class="col-sm-12 {{ $errors->has('faq_name')?'has-error':'' }}">
        {!! Form::text('faq_name', null, ['class' => 'form-control']) !!}
        @if($errors->has('faq_name'))
            <label class="has-error" for="faq_name">{{ $errors->first('faq_name') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row"><label class="col-sm-12 col-form-label is_required">Body</label>
    <div class="col-sm-12 {{ $errors->has('body')?'has-error':'' }}">
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        @if($errors->has('body'))
            <label class="has-error" for="body">{{ $errors->first('body') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label is_required"><b>Status</b></label>
    <div class="col-sm-12">
        @includeIf('admin.common.status_radio')
    </div>
</div>

