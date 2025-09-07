@include('admin.common.language-input', [ 'language' => $data['category']->lang ?? null ])

<div class="hr-line-dashed"></div>
<div class="form-group row">
    <label for="parent-category" class="col-sm-12 col-form-label">Parent Category</label>
    <div class="col-sm-12">
        {!! Form::select('parent_id', $data['parents'], null, ['placeholder' => 'Select Category', 'class' => 'form-control','id'=>'parent-category', ]) !!}
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-12 col-form-label is_required">Category name <span class="required">*</span> </label>
    <div class="col-sm-12 {{ $errors->has('category_name')?'has-error':'' }}">
        {!! Form::text('category_name', null, ['class' => 'form-control']) !!}
        @if($errors->has('category_name'))
            <label class="has-error" for="category_name">{{ $errors->first('category_name') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row">
    <label class="col-sm-12 col-form-label is_required">Category Slug <span class="required">*</span> </label>
    <div class="col-sm-12 {{ $errors->has('slug')?'has-error':'' }}">
        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
        @if($errors->has('slug'))
            <label class="has-error" for="slug">{{ $errors->first('slug') }}</label>
        @endif
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="form-group  row"><label class="col-sm-12 col-form-label is_required">Description</label>
    <div class="col-sm-12 {{ $errors->has('description')?'has-error':'' }}">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
        @if($errors->has('description'))
            <label class="has-error" for="description">{{ $errors->first('description') }}</label>
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

