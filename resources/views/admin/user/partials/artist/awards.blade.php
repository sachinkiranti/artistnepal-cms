<div role="tabpanel" id="tab-awards" class="tab-pane">
    <div class="panel-body p-0 m-0">

        <div class="row">
            <div class="col-sm-12">
                @php
                        $oldAwards = old('awards', $data['profile']->awards ?? [[]]);
                @endphp

                <table class="table table-bordered" id="awardsTable">
                    <thead>
                    <tr>
                        <th class="align-middle">Title</th>
                        <th class="align-middle">Date</th>
                        <th class="align-middle no-label">
                            <button type="button" class="btn btn-primary btn-xs" id="addRow">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($oldAwards as $index => $award)
                        <tr class="testimonial-row">
                            <td>
                                <input type="text" name="awards[{{ $index }}][title]" class="form-control" value="{{ $award['title'] ?? '' }}">
                            </td>
                            <td>
                                <input type="date" name="awards[{{ $index }}][date]" class="form-control" value="{{ $award['date'] ?? '' }}">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs remove-row">
                                    <i class="fa fa-trash"></i>
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
            const AwardManager = {
                table: $('#awardsTable'),
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
                },

                addRow: function () {
                    const newRow = this.rowTemplate.clone();

                    newRow.find('input').each((_, el) => {
                        const $el = $(el);
                        $el.val('');
                        const name = $el.attr('name').replace(/\[\d+\]/, `[${this.rowIndex}]`);
                        $el.attr('name', name);
                    });

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
                        alert('At least one award is required.');
                    }
                }
            };

            AwardManager.init();
        })
    </script>
@endpush
