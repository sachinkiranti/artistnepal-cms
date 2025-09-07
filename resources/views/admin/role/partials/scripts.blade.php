<script>
    $(function () {
        $( ".parent_selector" ).change(function() {
            $('.permission-wrapper').html('<div class="text-center mt-4">Loading <br><i class="fa fa-spinner fa-spin" style="font-size:50px"></i></div>');
            var roleId = $('.parent_selector').val();
            var route = "/admin/role/" + roleId + "/permissions";
            $.get(route, function(data){
                $('.permission-wrapper').html(data);
            });
        });

        $("#roleForm").validate({
            rules: {
                name: "required",
                slug: "required",
                description:{
                    minlength: 20,
                },
                status: "required",
            },
            messages: {
                name: "Please enter the name of the role.",
                slug: "Please provide a slug (url)."
            }
        });

        $(document).ready(function(){
            var body = $('body');

            body.on('click','.allPermission',function () {
                $('.permissionWrapperBody input').not(this).prop('checked', $(this).is(':checked'));
            });

            body.on('click','.subPermission',function () {
                $(this).parent('li').find('.subMenu input').not(this).prop('checked', $(this).is(':checked'));
                $(this).parent('li').find('.subMenu').slideToggle();
            });

            body.on('click','.action',function () {
                $(this).parent().find('.actionMenu input').not(this).prop('checked', $(this).is(':checked'));
            });

            $('.action').each(function () {
                if(this.checked){
                    $(this).closest('.subMenu').css("display", "block");
                    $(this).parent('li').parent('ul').parent('li').find('.subPermission').prop('checked', true);
                }
            });
        });
    })
</script>
