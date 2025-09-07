$(function () {
    var AdvertisementManager = {
        init: function () {
            this.cacheDom();
            this.bind();
        },

        cacheDom: function () {
            this.$advertisementManager = $('.advertisement-manager');
        },

        bind: function () {
            $(document).on('click', '#lfm', this.showFileManager);

            this.$advertisementManager.on('click', '.add-advertisement', this.addNewAdvertisementTr);
            this.$advertisementManager.on('click', '.delete-advertisement', this.removeAdvertisement);
        },

        removeAdvertisement: function () {
            var $this, countOfRow, row;
            $this = $(this);
            row = $this.parents('table').find('tbody tr.advertisement-row');
            countOfRow = row.length;

            if (countOfRow > 1) {
                $this.closest('tr').remove();
            } else {
                row.find(':input').val('');
                row.find('img').attr('src', '');
                random = Math.floor((Math.random() * 100000) + 1);
                thumbnail = 'thumbnail'+random;
                holder    = 'holder'+random;
                row.find('td > .input-group :input').attr('id', thumbnail);
                row.find('td > .input-group a').attr('data-input', thumbnail);
                row.find('td > .input-group a').attr('data-preview', holder);
                row.find('td > .input-group').next().attr('id', holder);

            }
            return false;
        },

        addNewAdvertisementTr: function () {
            var $this, $row, $clone, random, thumbnail, holder;
            $this = $(this);
            $row = $this.parents('table').find('tbody tr.advertisement-row:first');
            $clone = $row.clone();
            $clone.find(':input').val('');
            $clone.find('img').attr('src', '');
            random = Math.floor((Math.random() * 100000) + 1);
            thumbnail = 'thumbnail'+random;
            holder    = 'holder'+random;
            $clone.find('td > .input-group :input').attr('id', thumbnail);
            $clone.find('td > .input-group a').attr('data-input', thumbnail);
            $clone.find('td > .input-group a').attr('data-preview', holder);
            $clone.find('td > .input-group').next().attr('id', holder);

            $row.after($clone);
            return false;
        },

        showFileManager: function () {
            $(this).filemanager('image');
        },
    };

    AdvertisementManager.init();
});
