<div role="tabpanel" id="tab-experiences" class="tab-pane">
    <div class="panel-body p-0 m-0">

        <div class="row">
            <div class="col-sm-12">
                <div class=" {{ $errors->has('experiences')?'has-error':'' }}">
                    {!! Form::textarea('experiences', null, [ 'class' => 'form-control tinymce', 'placeholders' => '' ]) !!}
                    @if($errors->has('experiences'))
                        <label class="has-error" for="experiences">
                            {{ $errors->first('experiences') }}
                        </label>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

@push('js')
    <script src="{{ asset('dist/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(function () {
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                $(target).find('textarea.tinymce').each(function () {
                    if (!$(this).hasClass('tox-tinymce')) {
                        tinymce.init({
                            selector: 'textarea[name="' + $(this).attr('name') + '"]',
                            menubar: false,
                            plugins: 'lists link image',
                            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image'
                        });
                    }
                });
            });
        })
    </script>
@endpush
