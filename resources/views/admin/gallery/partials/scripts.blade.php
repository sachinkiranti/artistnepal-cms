<script>
    $(function () {
        $("#galleryForm").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please enter gallery name",
            }
        });
    })
</script>
