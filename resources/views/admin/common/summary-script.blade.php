<script>
    $(function () {
        $('.totalSelect').change( function (e) {
            $('.count-value').html('<i class="fa fa-spinner fa-spin"></i>');
            $.post('{{ route('admin.'. ($model ?? 'action') . '.count', $table) }}', {type: $(this).val(), _token: '{{ csrf_token() }}'})
                .done(function(data, status){
                    $.each(data.status, function (index, value) {
                        $('#summary-' + index).html(value);
                        $('#summary-' + index + '-name').html(index);
                    });
                })
                .fail(function () {
                    $('.count-value').html('<span class="text-danger" title="Error Getting Data"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>');
                });
        });
    })
</script>
