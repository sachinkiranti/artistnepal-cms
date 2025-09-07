$(function () {
    var WidgetManager = {
        init: function () {
            this.cacheDom();
            this.bind();
            this.initDraggable();
            this.initDroppable();
        },

        cacheDom: function () {
            this.$document = $(document);
            this.$widgetDroppableArea = $('.widget-droppable-area');
            this.$modal = $('#edit-model');
            this.$showTotalRectangeInput = $('.show-total-rectangle-input-wrapper');
        },

        bind: function () {
            this.$widgetDroppableArea.on('click', '.remove-widget', this.removeWidget);
            this.$document.on('change', 'select[name=template]', this.previewWidgetTemplate);
            this.$document.on('click', '.widget-preview-thumbnail', this.showWidgetOverlay);
            this.$widgetDroppableArea.on('click', '.save-widget', this.saveWidget);
            this.$widgetDroppableArea.on('click', '.delete-widget', this.deleteWidget);
            this.$widgetDroppableArea.on('click', '.edit-widget', this.editWidget);
            this.$widgetDroppableArea.on('click', '.add-advertisement', this.addAdvertisement);
            this.$document.on('click', '.update-widget', this.updateWidget);

            this.$document.on('click', '#lfm', this.showFileManager);

            this.$modal.on('show.bs.modal', this.getEditModalReady)
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
                utils.toast('Widget updated successfully!');
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
                            utils.toast('Widget deleted successfully!');
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
                utils.toast('Widget saved successfully!');
                widgetBox.replaceWith(data.body);
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
            utils.toast('Widget removed successfully!');
        },

        previewWidgetTemplate: function () {
            var widgetPreviewer = $(this).next('.widget-previewer'), template = $(this).val();
            var imagePath = utils.getImagePath('widgets/' + template + '.png');

            if (!utils.fileExists(imagePath)) {
                imagePath = utils.getImagePath('no-preview.jpeg');
            }

            widgetPreviewer.find('img').attr('src', imagePath);
            widgetPreviewer.show();
            WidgetManager.showOrHideExtraInput(template);
        },

        showOrHideExtraInput: function (template) {
            if (template !== 'list-with-rectangle-image') {
                $('.show-total-rectangle-input-wrapper').hide();
            } else {
                $('.show-total-rectangle-input-wrapper').show();
            }
        },

        initDraggable: function () {
            var newId = 0;
            $('.widget-draggable').draggable({
                cursor: 'move',
                revert: 'invalid',
                helper: function() {
                    var cloned = $(this).clone();
                    cloned.attr('id', (++newId).toString());

                    return cloned;
                },
                distance: 5
            });
        },

        initDroppable: function () {
            $(".widget-droppable").droppable({
                hoverClass: 'ui-state-active',
                tolerance: 'pointer',
                accept: function(event, ui) {
                    return true;
                },
                drop: function(event, ui) {
                    var wrapper, identifier, obj;
                    if ($(ui.helper).hasClass('widget-draggable')) {
                        obj = $(ui.helper).clone();
                        obj.removeClass('draggable').removeClass('widget-draggable').addClass('editable').removeAttr('style');

                        wrapper = obj.find('.'+obj.data('widget')+'-wrapper');
                        identifier = obj.data('widget');

                        utils.http.post(
                            router.get('admin.render.widget'),
                            { identifier: identifier, component: $(this).data('component') }
                        ).done(function (data) {
                            utils.toast('Widget loaded successfully!');
                            wrapper.html(data.body);
                        }).fail(function (jqXHR, textStatus) {

                        });
                        $(this).append(obj);
                    }
                }
            }).sortable({
                revert: false
            });
        }
    };

    WidgetManager.init();
});
