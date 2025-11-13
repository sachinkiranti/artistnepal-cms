<p><b>{{ ucwords(\Illuminate\Support\Str::limit($data->faq_name, 50)) }}</b></p>

<span class="label label-{{ $data->type ? 'success' : 'danger' }}">{{ \Foundation\Enums\FaqType::dropdown()[$data->type] ?? 'Unidentified' }}</span>
