@if(isset($data['roles']))
    <div class="hr-line-dashed"></div>
    <div class="form-group  row">
        <label class="col-sm-2 col-form-label">Parent Role</label>
        <div class="col-sm-10{{ $errors->has('parent_id') ? 'has-error' : '' }}">
            {!! Form::select('parent_id', $data['roles'], null, [ 'class' => 'form-control parent_selector', 'placeholder' => 'Select Parent']) !!}
            @if($errors->has('parent_id'))
                <label class="has-error" for="name">{{ $errors->first('parent_id') }}</label>
            @endif
        </div>
    </div>
@endif

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-2 col-form-label is_required">Name <span class="required">*</span></label>
    <div class="col-sm-10{{ $errors->has('name') ? 'has-error' : '' }}">
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
    <label class="col-sm-2 col-form-label is_required">Description</label>
    <div class="col-sm-10 {{ $errors->has('description') ? 'has-error' : '' }}">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        @if($errors->has('description'))
            <label class="has-error" for="description">{{ $errors->first('description') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group row mt-3">
    <label class="col-sm-2 col-form-label is_required">Status</label>
    <div class="col-sm-6">
        <div class="i-checks mt-2">
            <label for="active"> {!! Form::radio('status', 1, true, ['id' => 'active']) !!} <i></i> Active </label>
            <label for="inactive"> {!! Form::radio('status', 0, false, ['id' => 'inactive']) !!} <i></i> Inactive </label>
        </div>
    </div>
</div>

