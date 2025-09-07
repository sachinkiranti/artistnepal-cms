$(function () {
    var WrapperBuilder = {
        init: function () {
            this.cacheDom();
            this.bind();
            this.initBuilder();
        },

        cacheDom: function () {
        },

        bind: function () {
        },

        initBuilder: function () {
            this.initSortable();
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
                        $(this).find('input.sortable-depth').val(count++);
                    });
                }

            });
        }
    };

    WrapperBuilder.init();
});
