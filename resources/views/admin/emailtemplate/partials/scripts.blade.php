<script src="https://cdn.tiny.cloud/1/{{ env('TINY_MCE_KEY') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(function () {
        $("#emailtemplateForm").validate({
            rules: {
                name: "required",
                slug: "required",
                status: "required",
                type: "required",
                body:{
                    minlength: 10,
                },
            },
            messages: {
                name: "Please enter the name of Email Template",
                slug: "Please enter a unique slug."
            }
        });

        $(function () {
            tinymce.init({
                selector: 'textarea.tinymce-editor',
                height: 500,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help| pattern-selector | code',
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tiny.cloud/css/codepen.min.css'
                ],
                setup: function (editor) {

                    editor.ui.registry.addMenuButton('pattern-selector', {
                        text: 'Select Pattern For The Template',
                        fetch: function (callback) {
                            var items = patterns;
                            var itemsArr = [];
                            $.each(items, function (itemIndex, itemValue) {
                                itemsArr.push({
                                    type: 'menuitem',
                                    text: itemValue,
                                    value: itemIndex,
                                    onAction: function () {
                                        editor.insertContent(itemIndex);
                                    }
                                });
                            });
                            callback(itemsArr);

                        }
                    });
                }
            })
        });

        var patterns = {!! $data['email-patterns'] !!};
    })
</script>
