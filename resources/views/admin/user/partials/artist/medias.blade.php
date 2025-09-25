<div role="tabpanel" id="tab-medias" class="tab-pane">
    <div class="panel-body p-0 m-0">

        <div class="row">
            <div class="col-sm-12">
                @php
                    $oldMedias = old('medias', $data['profile']->medias ?? []);
                @endphp

                <table class="table table-bordered" id="mediasTable">
                    <thead>
                    <tr>
                        <th class="align-middle">Type</th>
                        <th class="align-middle">Media</th>
                        <th class="align-middle">Title</th>
                        <th class="align-middle">Description</th>
                        <th class="align-middle no-label">
                            <button type="button" class="btn btn-primary btn-xs" id="addRow">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($oldMedias as $index => $media)
                        @include('admin.user.partials.artist.tr.medias', [ 'isDefault' => false, ])
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
                    this.rowTemplate = $('.default-media-template').clone();
                    this.rowIndex = this.table.find('tbody tr').length;

                    this.bindEvents();
                },

                bindEvents: function () {
                    const self = this;

                    this.table.off('click', '#addRow').on('click', '#addRow', function () {
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
                    console.log('Hello')
                    const newRow = this.rowTemplate.clone();

                    newRow.removeClass('default-media-template');

                    newRow.find('input, select, textarea').each((_, el) => {
                        const $el = $(el);
                        $el.val('');
                        const name = $el.attr('name').replace(/\[\d+\]/, `[${this.rowIndex}]`);
                        $el.attr('name', name);
                        if ($el.is('input[type="file"]')) $el.val(null);
                    });

                    newRow.find('.preview').html('');
                    this.table.find('tbody').append(newRow);

                    if (tableInstances[this.table.selector]) {
                        tableInstances[this.table.selector].updateRow(newRow);
                    }

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
                    $input.replaceWith(`<input type="${type === '{{ \Foundation\Enums\MediaType::VIDEO->value }}' ? 'url' : 'file'}" name="${name}" class="form-control media-input">`);

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
