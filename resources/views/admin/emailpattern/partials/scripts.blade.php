<script>
    $(function () {
        $("#emailpatternForm").validate({
            rules: {
                name: "required",
            },
            messages: {
                name: "Please enter emailpattern name",
            }
        });
    })
</script>
