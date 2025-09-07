<script>
    $(function () {
        $("#tagForm").validate({
            rules: {
                tag_name: "required",
                status: "required",
                description:{
                    minlength: 10,
                },
            },
            messages: {
                tag_name: "Please enter tag name",
            }
        });
    })
</script>
