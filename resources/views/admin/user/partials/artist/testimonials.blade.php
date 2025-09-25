<div role="tabpanel" id="tab-testimonials" class="tab-pane">
    <div class="panel-body p-0 m-0">

        <div class="row">
            <div class="col-sm-12">
                @php
                    $oldTestimonials = old('testimonials', $data['profile']->testimonials ?? []);
                @endphp

                <table class="table table-bordered" id="testimonialTable">
                    <thead>
                    <tr>
                        <th class="align-middle">Content</th>
                        <th class="align-middle">Endorser</th>
                        <th class="align-middle">Endorser Title</th>
                        <th class="align-middle no-label">
                            <button type="button" class="btn btn-primary btn-xs" id="addRow">
                                <i class="fa fa-plus-circle"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($oldTestimonials as $index => $testimonial)
                        @include('admin.user.partials.artist.tr.testimonials', [ 'isDefault' => false, ])
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
            const TestimonialManager = {
                table: $('#testimonialTable'),
                rowTemplate: null,
                rowIndex: 0,

                init: function () {
                    this.rowTemplate = $('.default-testimonial-template').clone();
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

                    newRow.removeClass('default-testimonial-template');

                    newRow.find('textarea, input').each((_, el) => {
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
                        alert('At least one testimonial is required.');
                    }
                }
            };

            TestimonialManager.init();
        })
    </script>
@endpush
