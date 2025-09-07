$('body').on('click','.change-status', function () {
    var $this = $(this), text = $this.text(), id = $this.data('id'),
        url = $this.data('url'), csrf = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: {
            id: id,
            status: text,
            _token: csrf
        },
        success: function (data) {
            if (data.body) {
                $this.attr('class', '')
                    .text($.trim(text.toLowerCase()) === 'active' ? 'In-Active' : 'Active')
                    .addClass($.trim(text.toLowerCase()) === 'active' ? 'change-status label label-danger' : 'change-status label label-success');
                toastr.success('', 'Status changed successfully!');
            }

        }
    })
});

$(document).on('click','.confirm-delete-row',function (e) {
    swal({
        title: 'Do you want to delete?',
        text: "You won't be able to revert this!",
        type: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        html: false
    }, function (isConfirm) {
        if (isConfirm) {
            $('#formSubmit').submit();
        }
    })
});
