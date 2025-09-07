$(function () {
    var WidgetManager = {
        init: function () {
            this.cacheDom();
            this.bind();
            this.initFirst();
        },

        cacheDom: function () {
            this.$document = $(document);
            this.$modal = $('#edit-model');
            this.$showTotalRectangeInput = $('.show-total-rectangle-input-wrapper');
        },

        bind: function () {
            this.$document.on('click', '.remove-widget', this.removeWidget);
            this.$document.on('change', 'select[name=template]', this.previewWidgetTemplate);
            this.$document.on('click', '.widget-preview-thumbnail', this.showWidgetOverlay);
            this.$document.on('click', '.save-widget', this.saveWidget);
            this.$document.on('click', '.delete-widget', this.deleteWidget);
            this.$document.on('click', '.edit-widget', this.editWidget);
            this.$document.on('click', '.add-advertisement', this.addAdvertisement);
            this.$document.on('click', '.update-widget', this.updateWidget);

            this.$document.on('click', '#lfm', this.showFileManager);

            this.$modal.on('show.bs.modal', this.getEditModalReady)
        },

        initFirst: function() {
            this.$modal.modal("hide");
        },

        addAdvertisement: function () {
            utils.location(
                router.get('admin.advertisement.edit')
                    .replace('{component}', $(this).data('component'))
                    .replace('{widget}', $(this).data('widget'))
            );
        },

        showFileManager: function () {
            $(this).filemanager('image');
        },

        getEditModalReady: function () {
            WidgetManager.$modal
                .find('.update-widget')
                .prop("disabled", false)
                .html('Save changes');
        },

        updateWidget: function () {
            $(this)
                .prop("disabled", true)
                .html('Save changes ' + '<i class="fa fa-spinner fa-spin"></i>');

            var form = $(this).parents('.modal-content').find('form');

            if(! form[0].checkValidity()) {
                form.submit();
                return false;
            }

            var formData = { };
            $.each(form.serializeArray(), function() {
                formData[this.name] = this.value;
            });

            delete formData._method;

            utils.http.post(
                router.get('admin.update.widget').replace('{id}', formData.widget_id),
                formData
            ).done(function (data) {
                WidgetManager.$modal.modal("hide");
                // utils.toast('Widget updated successfully!');
                utils.reload(1000);
            }).fail(function (jqXHR, textStatus) {

            });

            return false;
        },

        editWidget: function () {
            var widgetId = $(this).data('widget'),
                componentName = $(this).data('component'),
                identifier = $(this).data('identifier');

            utils.http.post(
                router.get('admin.edit.widget').replace('{id}', widgetId),
                { widget_id: widgetId, component: componentName, identifier: identifier }
            ).done(function (data) {
                WidgetManager.$modal.find('.modal-title').text(identifier.replace('-', ' ').toUpperCase());
                WidgetManager.$modal.find('.modal-body').html(data.body);

                WidgetManager.$modal.modal("show");
            }).fail(function (jqXHR, textStatus) {

            });

            return false;
        },

        deleteWidget: function () {
            var widgetId = $(this).data('widget'),
                componentName = $(this).data('component'),
                parents = $(this).parents('.widget-show');

            swal({
                    title: "Are you sure?",
                    text: "Are you sure that you want to delete this widget?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "Yes, Delete it!",
                    confirmButtonColor: "#ec6c62"
                },
                function (isConfirm) {
                    if (isConfirm) {
                        utils.http.post(
                            router.get('admin.delete.widget'),
                            { widget_id: widgetId, component_name: componentName }
                        ).done(function (data) {
                            parents.remove();
                            swal.close();
                            // utils.toast('Widget deleted successfully!');
                        }).fail(function (jqXHR, textStatus) {

                        });
                    }
                });

            return false;
        },

        saveWidget: function () {
            var form = $(this).closest('form'), widgetBox = $(this).closest('.widget-box');

            if(! form[0].checkValidity()) {
                form.submit();
                return false;
            }

            var formData = { };
            $.each(form.serializeArray(), function() {
                formData[this.name] = this.value;
            });

            utils.http.post(
                router.get('admin.save.widget'),
                formData
            ).done(function (data) {
                // utils.toast('Widget saved successfully!');
                widgetBox.replaceWith(data.body);
                utils.reload();
            }).fail(function (jqXHR, textStatus) {

            });

            return false;
        },

        showWidgetOverlay: function () {
            $('#overlay-wrapper')
                .css({backgroundImage: `url(${this.src})`})
                .addClass('open')
                .one('click', function() { $(this).removeClass('open'); });
        },

        removeWidget: function () {
            $(this).parents('.widget-box').remove();
            // utils.toast('Widget removed successfully!');
        },

        previewWidgetTemplate: function () {
            var widgetPreviewer = $(this).next('.widget-previewer'), template = $(this).val();
            var imagePath = utils.getImagePath('widgets/' + template + '.png');

            widgetPreviewer.find('.loading-images').show();
            widgetPreviewer.find('img').hide();
            if (!utils.fileExists(imagePath)) {
                imagePath = utils.getImagePath('no-preview.jpeg');
            }

            widgetPreviewer.find('img').attr('src', imagePath);
            widgetPreviewer.find('.loading-images').hide();
            widgetPreviewer.find('img').show();
            widgetPreviewer.show();
            WidgetManager.showOrHideExtraInput(template);
        },

        showOrHideExtraInput: function (template) {
            if (template !== 'list-with-rectangle-image') {
                $('.show-total-rectangle-input-wrapper').hide();
            } else {
                $('.show-total-rectangle-input-wrapper').show();
            }
        }
    };

    WidgetManager.init();
});
