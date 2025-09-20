<div role="tabpanel" id="tab-medias" class="tab-pane">
    <div class="panel-body p-0 m-0">

        <div class="row">
            <div class="col-sm-12">
                @php
                    $oldMedias = old('medias', [[]]);
                @endphp

                <table class="table table-bordered" id="mediasTable">
                    <thead>
                    <tr>
                        <th class="align-middle">Type</th>
                        <th class="align-middle">Media</th>
                        <th class="align-middle">Title</th>
                        <th class="align-middle">Description</th>
                        <th class="align-middle">
                            <button type="button" class="btn btn-primary btn-xs" id="addRow">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($oldMedias as $index => $media)
                        <tr class="media-row">
                            <td>
                                <select name="medias[{{ $index }}][type]" class="form-control media-type">
                                    <option value="image" {{ (isset($media['type']) && $media['type'] == 'image') ? 'selected' : '' }}>Image</option>
                                    <option value="video" {{ (isset($media['type']) && $media['type'] == 'video') ? 'selected' : '' }}>Video</option>
                                </select>
                            </td>
                            <td>
                                <input type="{{ (isset($media['type']) && $media['type'] == 'video') ? 'url' : 'file' }}"
                                       name="medias[{{ $index }}][media]"
                                       class="form-control media-input">
                                <div class="preview mt-1">
                                    @if(isset($media['type']) && $media['type'] == 'image' && isset($media['media']))
                                        <img src="{{ $media['media'] }}" style="max-width: 100px;">
                                    @endif
                                </div>
                            </td>
                            <td>
                                <textarea name="medias[{{ $index }}][title]" class="form-control" rows="2">{{ $media['title'] ?? '' }}</textarea>
                            </td>
                            <td>
                                <textarea name="medias[{{ $index }}][description]" class="form-control" rows="2">{{ $media['description'] ?? '' }}</textarea>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs remove-row">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@push('js')
    <script>
        $(function () {

            const MediaManager = {
                table: $('#mediasTable'),
                rowTemplate: null,
                rowIndex: 0,

                init: function () {
                    this.rowTemplate = this.table.find('tbody tr:first').clone();
                    this.rowIndex = this.table.find('tbody tr').length;

                    this.bindEvents();
                },

                bindEvents: function () {
                    const self = this;

                    this.table.on('click', '#addRow', function () {
                        self.addRow();
                    });

                    this.table.on('click', '.remove-row', function () {
                        self.removeRow($(this));
                    });

                    this.table.on('change', '.media-type', function () {
                        self.updateMediaInput($(this));
                    });

                    this.table.on('change', '.media-input[type="file"]', function () {
                        self.previewImage($(this));
                    });
                },

                addRow: function () {
                    const newRow = this.rowTemplate.clone();

                    newRow.find('input, select, textarea').each((_, el) => {
                        const $el = $(el);
                        $el.val('');
                        const name = $el.attr('name').replace(/\[\d+\]/, `[${this.rowIndex}]`);
                        $el.attr('name', name);
                        if ($el.is('input[type="file"]')) $el.val(null);
                    });

                    newRow.find('.preview').html('');
                    this.table.find('tbody').append(newRow);
                    this.rowIndex++;
                },

                removeRow: function ($button) {
                    const rowCount = this.table.find('tbody tr').length;
                    if (rowCount > 1) {
                        $button.closest('tr').remove();
                    } else {
                        alert('At least one media is required.');
                    }
                },

                updateMediaInput: function ($select) {
                    const type = $select.val();
                    const $row = $select.closest('tr');
                    const $input = $row.find('.media-input');

                    const name = $input.attr('name');
                    $input.replaceWith(`<input type="${type === 'video' ? 'url' : 'file'}" name="${name}" class="form-control media-input">`);

                    $row.find('.preview').html('');
                },

                previewImage: function ($input) {
                    const $preview = $input.closest('td').find('.preview');
                    const file = $input[0].files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $preview.html(`<img src="${e.target.result}" style="max-width:100px;">`);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        $preview.html('');
                    }
                }
            };

            MediaManager.init();
        });
    </script>
@endpush
