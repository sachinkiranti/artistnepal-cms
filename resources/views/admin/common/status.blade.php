@php
    $status = $data->status ?? $data->is_enabled;
@endphp

@if ($status)
<span class="label label-success">Active</span>
@else
<span class="label label-danger">In-Active</span>
@endif
