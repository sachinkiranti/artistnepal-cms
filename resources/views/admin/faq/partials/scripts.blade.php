<script>
    $(function () {
        $("#faqFrom").validate({
            rules: {
                faq_name: "required",
                status: "required",
                body:{
                    minlength: 10,
                },
            },
            messages: {
                status: "Please select a status",
            }
        });

    })
</script>
