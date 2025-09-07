$(function () {
    var GalleryManager = {
        init: function () {
            this.cacheDom();
            this.bind();
            this.initPlugin();
        },

        cacheDom: function () {
            this.$galleryManager = $('.gallery-manager');
        },

        bind: function () {
            $(document).on('click', '#lfm', this.showFileManager);

            this.$galleryManager.on('click', '.add-gallery', this.addNewGalleryTr);
            this.$galleryManager.on('click', '.delete-gallery', this.removeGallery);
        },

        removeGallery: function () {
            var $this, countOfRow;
            $this = $(this);
            countOfRow = $this.parents('table').find('tbody tr.gallery-row').length;

            if (countOfRow > 1) {
                $this.closest('tr').remove();
            }
            return false;
        },

        addNewGalleryTr: function () {
            var $this, $row, $clone, random, thumbnail, holder;
            $this = $(this);
            $row = $this.parents('table').find('tbody tr.gallery-row:first');
            $clone = $row.clone();
            $clone.find(':input').val('');
            $clone.find('img').attr('src', '');
            random = Math.floor((Math.random() * 100000) + 1);
            thumbnail = 'thumbnail'+random;
            holder    = 'holder'+random;
            console.log(thumbnail, holder);
            $clone.find('td > .gallery-media-wrapper :input').attr('id', thumbnail);
            $clone.find('td > .gallery-media-wrapper a').attr('data-input', thumbnail);
            $clone.find('td > .gallery-media-wrapper a').attr('data-preview', holder);
            $clone.find('td > .gallery-media-wrapper .gallery-media-holder').attr('id', holder);

            $row.after($clone);
            return false;
        },

        showFileManager: function () {
            $(this).filemanager('image');
        },

        initPlugin:  function () {
            $('.dropify').dropify()
        }
    };

    GalleryManager.init();
});
