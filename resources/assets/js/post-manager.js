$(function () {
    var postManager = {
        init:function () {
            this.cacheDom();
            this.bind();
            this.initPlugins();
        },
        cacheDom:function () {
            this.$childCategorywrapper = $('.sub-category-wrapper');

            /* Input field*/
            this.$parentCategoryField = $('#select-category');
            this.$childCategoryField = $('.subCategory-select');

        },
        bind:function () {
        },
        initPlugins: function () {
            $('.dropify').dropify();
            $("#postForm").validate({
                rules: {
                    title: "required",
                    category: "required",
                    post_type: "required",
                    status: "required",
                    content: {
                        minlength: 10,
                        maxlength:1000,
                    },
                    seo_title:{
                        maxlength: 150,
                    },
                    seo_slug:{
                        maxlength: 150,
                    },
                    seo_desc:{
                        maxlength: 150,
                    },
                    seo_keywords:{
                        maxlength: 150,
                    },
                },
            });

            $('.post-select-multiple').select2({
                placeholder: "Select a Tag",
                allowClear: true
            });

            $('.category-select').select2({
                placeholder: "Select a Category",
                allowClear: true
            });

            $('.i-checks-checkbox').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            this.initTinyMce();
        },

        initTinyMce: function () {
            var editor_config = {
                selector: '#content',
                height: 500,
                path_absolute : "/",
                theme: 'modern',
                plugins: [
                    "textcolor", "colorpicker", "code",
                    'advlist autolink lists link image charmap print preview hr anchor table pagebreak youtube', "imagetools"
                ],
                toolbar: 'undo redo | formatselect | sizeselect | bold italic | fontselect |  fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help| ads-selector | image | code | youtube | colorpicker | textcolor | table',
                fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
                relative_urls: false,
                extended_valid_elements: "+iframe[src|width|height|name|align|class]",
                external_plugins: {
                    'Youtube': utils.getRootPath() +'dist/plugins/tinymce/plugins/youtube/plugin.min.js'
                },
                force_br_newlines : true,
                force_p_newlines : false,
                gecko_spellcheck : true,
                forced_root_block : '', // Needed for 3.x
                style_formats: [{
                    title: 'Image Left', selector: 'img', styles: {
                        'float' : 'left',
                        'margin': '0 10px 0 10px'
                    }},
                    {
                        title: 'Image Right', selector: 'img', styles: {
                            'float' : 'right',
                            'margin': '0 10px 0 10px'
                        }}
                ],
                image_advtab: true,
                remove_linebreaks : false,
                setup: function (editor) {
                    editor.addButton('ads-selector', {
                        icon: 'icon-ads',
                        title: 'Select Ads Placeholders',
                        onclick: function () {

                            editor.windowManager.open({
                                title: 'Select Ads Placeholders - Ads Management',
                                body: [
                                    {
                                        type: 'listbox',
                                        name: 'ads_placeholder',
                                        values: [
                                            { text: 'Ads Placeholder 1', value: '{ADS_PLACEHOLDER_1}' },
                                            { text: 'Ads Placeholder 2', value: '{ADS_PLACEHOLDER_2}' },
                                            { text: 'Ads Placeholder 3', value: '{ADS_PLACEHOLDER_3}' },
                                            { text: 'Ads Placeholder 4', value: '{ADS_PLACEHOLDER_4}' },
                                            { text: 'Ads Placeholder 5', value: '{ADS_PLACEHOLDER_5}' },
                                            { text: 'Ads Placeholder 6', value: '{ADS_PLACEHOLDER_6}' },
                                            { text: 'Ads Placeholder 7', value: '{ADS_PLACEHOLDER_7}' },
                                            { text: 'Ads Placeholder 8', value: '{ADS_PLACEHOLDER_8}' },
                                            { text: 'Ads Placeholder 9', value: '{ADS_PLACEHOLDER_9}' },
                                            { text: 'Ads Placeholder 10', value: '{ADS_PLACEHOLDER_10}' },
                                        ],
                                        value: '3'
                                    }
                                ],
                                onsubmit: function(v) {
                                    editor.insertContent(v.data.ads_placeholder);
                                }
                            });

                        }
                    });

                    editor.on('NodeChange', function (e) {
                        if(e && e.element.nodeName.toLowerCase() === 'img') {
                            var wrapper = document.createElement("div");
                            wrapper.classList.add("features-image", "sub-f_img");

                            var imgEl = document.createElement("img");
                            imgEl.setAttribute("data-original", e.element.getAttribute('src'));
                            imgEl.setAttribute("src", e.element.getAttribute('src'));
                            imgEl.setAttribute("width", e.element.getAttribute('width'));
                            imgEl.setAttribute("height", e.element.getAttribute('height'));
                            imgEl.setAttribute("style", e.element.getAttribute('style'));
                            imgEl.setAttribute("alt", e.element.getAttribute('alt'));

                            imgEl.classList.add("small-sq-imgs");

                            wrapper.appendChild(imgEl)
                            var captionText = e.element.getAttribute('alt');
                            if (!$(e.element).parents('.features-image').length) {
                                $(e.element).parents('.features-image').unwrap();
                                var caption = document.createElement("div");
                                caption.innerText = captionText;
                                caption.classList.add('caption');
                                if (captionText) {
                                    wrapper.appendChild(caption)
                                }
                                $(e.element).replaceWith(wrapper)
                            } else {
                                $(e.element).parents('.features-image').find('.caption').html(captionText);
                            }


                        }
                    });
                },
                file_browser_callback : function(field_name, url, type, win) {

                    let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'media?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }
                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };

            tinymce.init(editor_config);

        }
    };
    postManager.init();

})
