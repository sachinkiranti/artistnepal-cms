@include('admin.common.language-input', [ 'language' => $data['faq']->lang ?? null ])

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-12 col-form-label is_required">Faq Type <span class="required">*</span></label>
    <div class="col-sm-12 {{ $errors->has('type')?'has-error':'' }}">

        <select name="type" class="form-control">
            @foreach($data['types'] as $faqTypeIndex => $faqType)
                <option value="{{ $faqTypeIndex }}" {{ (($data['faq']->type ?? '') == $faqTypeIndex) ? 'selected' : '' }}>{{ $faqType }}</option>
            @endforeach
        </select>

        @if($errors->has('type'))
            <label class="has-error" for="type">{{ $errors->first('type') }}</label>
        @endif
    </div>
</div>


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
<div class="form-group row"><label class="col-sm-12 col-form-label is_required">Main Content</label>
    <div class="col-sm-12 {{ $errors->has('body')?'has-error':'' }}">
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        @if($errors->has('body'))
            <label class="has-error" for="body">{{ $errors->first('body') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row"><label class="col-sm-12 col-form-label is_required">Secondary</label>
    <div class="col-sm-12 {{ $errors->has('secondary_body')?'has-error':'' }}">
        {!! Form::textarea('secondary_body', null, ['class' => 'form-control', 'rows' => 3]) !!}
        @if($errors->has('secondary_body'))
            <label class="has-error" for="secondary_body">{{ $errors->first('secondary_body') }}</label>
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

