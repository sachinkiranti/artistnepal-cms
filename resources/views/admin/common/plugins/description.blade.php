<script type="text/javascript" src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey={{ \Wizard\Config\Web::TINY_MCE_API_KEY }}' defer></script>
<script>
    $(function () {
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
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

                /* example, adding a toolbar menu button */
                {{--editor.ui.registry.addMenuButton('pattern-selector', {--}}
                {{--    text: 'Select Pattern For The Template',--}}
                {{--    fetch: function (callback) {--}}
                {{--        var templateKey = editor.id.replace('[template-body]', '');--}}
                {{--        $.ajax({--}}
                {{--            data: {--}}
                {{--                template: templateKey--}}
                {{--            },--}}
                {{--            url:  "{{ route('action.render.template-patterns') }}",--}}
                {{--            type: 'GET',--}}
                {{--        }).done(function (response) {--}}
                {{--            var itemsArr = [];--}}

                {{--            $.each(response.body, function (itemIndex, itemValue) {--}}
                {{--                itemsArr.push({--}}
                {{--                    type: 'menuitem',--}}
                {{--                    text: itemValue,--}}
                {{--                    value: itemIndex,--}}
                {{--                    onAction: function () {--}}
                {{--                        editor.insertContent(itemIndex);--}}
                {{--                    }--}}
                {{--                });--}}
                {{--            });--}}
                {{--            callback(itemsArr);--}}
                {{--        });--}}
                {{--        --}}
                {{--    }--}}
                {{--});--}}
            }
        })
    })
</script>
