@php
    $status = $data->status ?? $data->is_enabled;
@endphp

@if ($status)
<span class="label label-success">{{ \Kiranti\Config\Status::$current[1] }}</span>
@else
<span class="label label-danger">{{ \Kiranti\Config\Status::$current[0] }}</span>
@endif
