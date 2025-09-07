<div class="form-group {{ $errors->has('entity-sub-rules') ? 'has-error' : '' }} sub-items-wrapper">

    <label class="control-label" for="entity-sub-rules">
        {{ __('Entity Sub Rules') }}
    </label>

    {!!
        app('form')->select('entity-sub-rules', $entitySubRules, null,
            [ 'placeholder' => 'Select Entity Rules', 'class' => 'form-control multiple-select', ])
    !!}
WWWWWWWW
</div>
