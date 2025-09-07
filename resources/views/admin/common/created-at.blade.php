@php
    $createdAt = optional($data->created_at)->diffForHumans();
@endphp
{{ $data->created_at }} <br> <code>{{ $createdAt }}</code>
