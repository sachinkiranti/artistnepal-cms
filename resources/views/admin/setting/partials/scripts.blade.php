<script>
    $(function () {

        $('.dropify').dropify();

        $('.dropify-social-homepage').dropify({
            messages: {
                'default': 'Drag and drop a social image for homepage right here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        })

        $("#setting-form").validate({
            rules: {
                company: "required",
            },
        });

        $('.select-options').select2({
            placeholder: "Select a option",
            allowClear: true
        });
    })

</script>
