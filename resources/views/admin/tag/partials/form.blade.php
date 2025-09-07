@include('admin.common.language-input', [ 'language' => $data['tag']->lang ?? null ])

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-12 col-form-label is_required">tag name <span class="required">*</span> </label>
    <div class="col-sm-12 {{ $errors->has('username')?'has-error':'' }}">
        {!! Form::text('tag_name', null, ['class' => 'form-control']) !!}
        @if($errors->has('tag_name'))
            <label class="has-error" for="tag_name">{{ $errors->first('tag_name') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-12 col-form-label is_required">description</label>
    <div class="col-sm-12 {{ $errors->has('description')?'has-error':'' }}">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-12 col-form-label is_required"><b>status</b></label>
    <div class="col-sm-12">
        @includeIf('admin.common.status_radio')
    </div>
</div>

