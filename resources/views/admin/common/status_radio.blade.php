<div class="i-checks mt-2">
    <label for="active"> {!! Form::radio('status', 1, true, ['id' => 'active']) !!} <i></i> Active </label>
    <label for="inactive"> {!! Form::radio('status', 0, false, ['id' => 'inactive']) !!} <i></i> Inactive </label>
    <div>
        @if($errors->has('status'))
            <label class="has-error" for="status">{{ $errors->first('status') }}</label>
        @endif
    </div>
</div>
