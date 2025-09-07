<span data-id="{{ $data[$model]->id }}"
      data-url="{{ route('admin.actions.status', $data[$model]->getTable()) }}"
      data-status="{{ $data[$model]->status }}"
      class="change-status label label-{{ $data[$model]->status ? 'success' : 'danger' }}">
    {{ \Kiranti\Config\Status::$current[$data[$model]->status] }}
</span>
