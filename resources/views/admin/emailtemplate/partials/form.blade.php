<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">Name <span class="required">*</span></label>
    <div class="col-sm-10 {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::text('name', null, [ 'class' => 'form-control' ]) !!}
        @if($errors->has('name'))
            <label class="has-error" for="name">{{ $errors->first('name') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">Slug <span class="required">*</span></label>
    <div class="col-sm-10 {{ $errors->has('slug') ? 'has-error' : '' }}">
        {!! Form::text('slug', null, [ 'class' => 'form-control' ]) !!}
        @if($errors->has('slug'))
            <label class="has-error" for="slug">{{ $errors->first('slug') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">Body</label>
    <div class="col-sm-10 {{ $errors->has('body') ? 'has-error' : '' }}">
        {!! Form::textarea('body', null, ['class' => 'form-control tinymce-editor']) !!}
        @if($errors->has('body'))
            <label class="has-error" for="body">{{ $errors->first('body') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">Template Type <span class="required">*</span></label>
    <div class="col-sm-10 {{ $errors->has('type') ? 'has-error' : '' }}">
        {!! Form::select('type', ['1' => 'System', '2' => 'Other'], null, ['class' => 'form-control']) !!}
        @if($errors->has('type'))
            <label class="has-error" for="body">{{ $errors->first('type') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label is_required">Status</label>
    <div class="col-sm-10">
        <div class="i-checks mt-2">
            <label for="active"> {!! Form::radio('status', 1, true, ['id' => 'active']) !!} <i></i> Active </label>
            <label for="inactive"> {!! Form::radio('status', 0, false, ['id' => 'inactive']) !!} <i></i> Inactive </label>
        </div>
    </div>
</div>
