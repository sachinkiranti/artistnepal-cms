<script>
    $(function () {
        $('.select2_role').select2({
            placeholder: "Select a Role",
            allowClear: true
        });

        var value = $("#password").val();
        $.validator.addMethod("checkLower", function(value) {
            return /[a-z]/.test(value);
        });
        $.validator.addMethod("checkUpper", function(value) {
            return /[A-Z]/.test(value);
        });
        $.validator.addMethod("checkDigit", function(value) {
            return /[0-9]/.test(value);
        });
        $.validator.addMethod("checkSpecialCharacter", function(value) {
            return /[@$!%*#?&]/.test(value);
        });
        $("#userForm").validate({
            rules: {
                first_name:{
                    required: true,
                    minlength: 2,
                },
                last_name:{
                    required: true,
                    minlength: 2,
                },
                email:{
                    required: true,
                    email: true
                },
                status: "required",
                password:{
                    required: true,
                    minlength: 9,
                    checkLower: true,
                    checkUpper: true,
                    checkDigit: true,
                    checkSpecialCharacter: true,
                },
                password_confirmation: {
                    equalTo : "#password"
                },
                'roles[]': "required",
            },
            messages: {
                password: {
                    checkLower: "Must contain at least one lowercase letter",
                    checkUpper: "Must contain at least one uppercase letter",
                    checkDigit: "Must contain at least one digit",
                    checkSpecialCharacter: "Must contain a special character",
                },
                password_confirmation: "Password Confirmation does not match the password"
            }

        });
    })

</script>
