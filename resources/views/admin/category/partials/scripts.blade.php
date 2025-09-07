<script>
    $(function () {

        $("#categoryForm").validate({
            rules: {
                category_name: "required",
                category_slug: "required",
                status: "required",
                description:{
                    minlength: 10,
                },
            },
        });

        /* Load sub Category */
        {{--$('body').on('change','#parent-category',function () {--}}
        {{--    var $this = $(this), parentCategory = $this.val(), csrf = $('meta[name="csrf-token"]').attr('content');--}}

        {{--    if(parentCategory.length){--}}
        {{--        $.ajax({--}}
        {{--            url: '{{ route('admin.job.sub-category') }}',--}}
        {{--            method: 'POST',--}}
        {{--            dataType: 'json',--}}
        {{--            data: {categoryId: parentCategory,_token:csrf},--}}
        {{--            success: function (data) {--}}
        {{--                let result = null;--}}
        {{--                result += '<option>Select Subcategory</option>';--}}
        {{--                $.each(data.body, function (id, subCategory) {--}}
        {{--                    result += '<option value='+ id +'>'+ subCategory + '</option>';--}}
        {{--                });--}}
        {{--                $('#child-category').empty().html(result);--}}
        {{--            }--}}

        {{--        })--}}
        {{--    }--}}
        {{--});--}}

    })
</script>
