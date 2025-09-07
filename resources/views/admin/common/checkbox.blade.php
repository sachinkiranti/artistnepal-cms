@php
    $data = $data->id ?? null;
    $modelName = isset($name) ? $model : '';
    $attrs = isset($name) ? 'data-model="'.$modelName.'"' : '';
@endphp
{!! Form::checkbox($name ?? 'single-checkbox', $data, false, [ 'id'=> $id ?? "single-checkbox".$data, 'class' => 'bulk-action-input', $attrs, ]) !!}
<label class="label label-default bulk-action-label" for="{{  $id ?? 'single-checkbox'. $data }}"></label>

