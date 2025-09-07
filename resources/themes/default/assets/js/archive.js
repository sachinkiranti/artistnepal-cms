$(function () {
    $('.category-list').on('click', '.load-more-news', function (event) {
        event.preventDefault();
        // $(this).prop(
        //     'disabled', true
        // );
        var wrapper = $('.posts-loaded'), $this = $(this), total = $this.data('count');

        utils.http.post(
            router.get('post.load-more-data'),
            { _offset: wrapper.length, _categoryId: $this.data('category') }
        ).done(function (response) {
            response = response.body;
            if (response.count > 0 && total >= (wrapper.length + 5)) {
                $(response.render).insertAfter('.posts-loaded:last');
            } else {
                $this.remove();
            }
            // $(this).prop(
            //     'disabled', false
            // );
        });
    });
});
