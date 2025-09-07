<div class="menu-props">
    <form>
        <div class="form-group row col-sm-12">
            <label class="col-sm-12 col-form-label is_required"><b>URL</b> <span class="required" style="color: red;">*</span></label>
            <div class="col-sm-12 {{ $errors->has('url')?'has-error':'' }}">
                {!! Form::url('url', null, ['class' => 'form-control', 'required', ]) !!}
                @if($errors->has('url'))
                    <label class="has-error" for="url">{{ $errors->first('url') }}</label>
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group row col-sm-12">
            <label class="col-sm-12 col-form-label is_required"><b>Text</b> <span class="required" style="color: red;">*</span></label>
            <div class="col-sm-12 {{ $errors->has('text')?'has-error':'' }}">
                {!! Form::text('text', null, ['class' => 'form-control', 'required', ]) !!}
                @if($errors->has('text'))
                    <label class="has-error" for="text">{{ $errors->first('text') }}</label>
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group row col-sm-12">
            <label class="col-sm-12 col-form-label is_required"><b>Target</b> <span class="required" style="color: red;">*</span></label>
            <div class="col-sm-12 {{ $errors->has('target')?'has-error':'' }}">
                {!! Form::select('target', $data, null, ['class' => 'form-control', 'required', ]) !!}
                @if($errors->has('target'))
                    <label class="has-error" for="text">{{ $errors->first('target') }}</label>
                @endif
            </div>
        </div>
    </form>
</div>
