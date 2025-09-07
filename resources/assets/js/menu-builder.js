$(function () {
    var MenuBuilder = {
        init: function () {
            this.cacheDom();
            this.bind();
            this.initBuilder();
        },

        cacheDom: function () {
            this.$menuManager = $('.menu-manager');
            this.$modal = this.$menuManager.find('#menu-model');
        },

        bind: function () {
            this.$menuManager.on('click', '.add-to-menu', this.addToMenuSection);
            this.$menuManager.on('click', '.edit-menu-li', this.editMenuModal);
            this.$menuManager.on('click', '.remove-menu-li', this.removeMenu);
            this.$menuManager.on('click', '.save-menu-changes', this.saveModalChanges);
            this.$menuManager.on('change', '.menu-section-selector', this.loadMenuBySection);
            this.$menuManager.on('click', '.save-menu-list', this.save);
        },

        save: function () {
            if (!$('.sortable-menu-list-li').length) {
                utils.toast('Please select menu section first :) !');
                return false;
            }
        },

        removeMenu: function () {
            $(this).parents('.sortable-menu-list-li').remove();
            return false;
        },

        processing: function (el) {
            el.prop("disabled", true)
                .html('<i class="fa fa-plus"></i>' + ' Add to menu ' + '<i class="fa fa-spinner fa-spin"></i>');
        },

        completed: function (el) {
            el.prop("disabled", false)
                .html('<i class="fa fa-plus"></i>' + ' Add to menu ');
        },

        loadMenuBySection: function () {
            var $this = $(this), section = $this.val();
            $this.prop("disabled", true);
            utils.http.post(
                router.get('admin.render.menu'),
                { section: section }
            ).done(function (data) {
                $('.menu-list-wrapper').html(data.body);
                $this.prop("disabled", false);
                MenuBuilder.initSortable();
                utils.toast('Menu loaded successfully!');
            });
        },

        addToMenuSection: function () {
            MenuBuilder.processing($(this));

            var data, menuType = $(this).data('menuType'), indexing;

            switch (menuType) {
                case 'Custom Link':
                    data = MenuBuilder.resolveFormData($(this).parents('.card-body').find('form'));
                    break;
                default:
                    data = MenuBuilder.checkedData($(this).parents('.card-body').find('input[name=menu]:checked'));
            }

            var $row = $('.sortable-menu-list li:last-child');
            var $clone = $row.clone(), $copy;
            if (menuType === 'Custom Link') {
                $copy = $clone.clone();

                // indexing =  $('.sortable-menu-list li').length + 1;
                indexing =  MenuBuilder.generateRandomNumber();
                $copy.attr('data-index', indexing);
                $copy.find("input").each(function () {
                    $(this).attr('name', $(this).attr('name').replace($clone.data('index'), indexing));
                });

                $copy.attr('data-name', data.text);
                $copy.find('input[name="menu['+indexing+'][default]"]').remove();
                $copy.find('input[name="menu['+indexing+'][label]"]').val(data.text);
                $copy.find('input[name="menu['+indexing+'][value]"]').val(data.url);
                $copy.find('input[name="menu['+indexing+'][target]"]').val(data.target);
                $copy.find('input[name="menu['+indexing+'][menu-type]"]').val(menuType);
                $copy.find('.menu-title').html(data.text);
                $copy.find('.menu-type').html('[' + menuType + ']');

                $row.after($copy);
                $copy.show();
            } else {
                for (const [key, value] of Object.entries(data)) {
                    $copy = $clone.clone();

                    indexing =  MenuBuilder.generateRandomNumber();
                    $copy.attr('data-index', indexing);

                    $copy.find("input").each(function () {
                        $(this).attr('name', $(this).attr('name').replace($clone.data('index'), indexing));
                    });

                    $copy.attr('data-name', key);
                    $copy.find('input[name="menu['+indexing+'][default]"]').remove();
                    $copy.find('input[name="menu['+indexing+'][label]"]').val(key);
                    $copy.find('input[name="menu['+indexing+'][value]"]').val(value);
                    $copy.find('input[name="menu['+indexing+'][menu-type]"]').val(menuType);
                    $copy.find('.menu-title').html(key);
                    $copy.find('.menu-type').html('[' + menuType + ']');

                    $row.after($copy);
                    $copy.show();
                }
            }

            MenuBuilder.completed($(this));
            return false;
        },

        generateRandomNumber: function () {
            return Math.floor((Math.random() * 99999) + 1);
        },

        resolveFormData: function (el) {
            if(! el[0].checkValidity()) {
                el.submit();
                return false;
            }

            var formData = { };
            $.each(el.serializeArray(), function() {
                formData[this.name] = this.value;
            });

            el[0].reset();
            return formData;
        },

        checkedData: function (el) {
            var data = [];

            $.each(el, function () {
                data[$(this).data('title')] = $(this).val();
            });

            $(":checkbox").prop('checked',false);

            return data;
        },

        editMenuModal: function () {
            var menuLiWrapper = $(this).parents('.sortable-menu-list-li'), indexing;
            menuLiWrapper.addClass('last-checked-out-menu');
            indexing = menuLiWrapper.data('index');
            var label = menuLiWrapper.find('input[name="menu['+ indexing +'][label]"]').val();
            var cssClass = menuLiWrapper.find('input[name="menu['+ indexing +'][class]"]').val();
            var icon = menuLiWrapper.find('input[name="menu['+ indexing +'][icon]"]').val();
            var target = menuLiWrapper.find('input[name="menu['+ indexing +'][target]"]').val();


            MenuBuilder.$modal.find('input[name=label]').val(label);
            MenuBuilder.$modal.find('input[name=class]').val(cssClass);
            MenuBuilder.$modal.find('input[name=icon]').val(icon);
            MenuBuilder.$modal.find('select[name=target]').val(target);
            MenuBuilder.$modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            return false;
        },

        saveModalChanges: function () {
            var menuLiWrapper = $('.last-checked-out-menu'), indexing;
            indexing = menuLiWrapper.data('index');

            var label = MenuBuilder.$modal.find('input[name=label]').val();
            var cssClass = MenuBuilder.$modal.find('input[name=class]').val();
            var icon = MenuBuilder.$modal.find('input[name=icon]').val();
            var target = MenuBuilder.$modal.find('select[name=target]').val();

            menuLiWrapper.find('input[name="menu['+ indexing +'][label]"]').val(label);
            menuLiWrapper.find('input[name="menu['+ indexing +'][class]"]').val(cssClass);
            menuLiWrapper.find('input[name="menu['+ indexing +'][icon]"]').val(icon);
            menuLiWrapper.find('input[name="menu['+ indexing +'][target]"]').val(target);
            menuLiWrapper.find('.menu-title').html(label);
            MenuBuilder.$modal.modal("hide");
            return false;
        },

        initBuilder: function () {
            this.initSortable();

            this.$modal.on('hidden.bs.modal', function () {
                $('.sortable-menu-list-li').removeClass('last-checked-out-menu');
            });
        },

        initSortable: function () {
            $('ul.sorter').multisortable({
                // CSS class when selected
                selectedClass: 'selected',
                // item selector
                items: 'li',
                stop: function(e){
                    var count = 1;
                    $('ul.sorter > li').each(function () {
                        var priority = count++;
                        $(this).find('input.sortable-depth').val(priority);
                    });
                }

            });
        }
    };

    MenuBuilder.init();
});
