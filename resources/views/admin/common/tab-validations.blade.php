<script>
    $(function () {
        /* Tab Validations */
        var tabContent = '.tab-content', navTabsChildren = $( '.nav-tabs').children('li');

        if ($(tabContent).find('.has-error').text()) {
            $.each($(tabContent).find('.has-error'), function (index, value) {
                var $this = $(this);
                if ($this.text()) {
                    $(tabContent).children('.tab-pane').removeClass('active');
                    $this.closest('.tab-pane').addClass('active');
                    navTabsChildren.removeClass('active');
                    var id = $this.closest('.tab-pane').attr('id');
                    $.each(navTabsChildren, function (i, a) {
                        if (('#' + id) === $this.children('a').attr('href'))
                            $this.addClass('active');
                    });
                    return false;
                }
            });
        }
    });
</script>
