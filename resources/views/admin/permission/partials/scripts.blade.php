<script>
    $(function () {
        $("#permissionForm").validate({
            rules: {
                name: "required",
                slug: "required",
                status: "required",
                description:{
                    minlength: 10,
                },
            },
            messages: {
                name: "Please enter permission name",
            }
        });
    })
</script>
