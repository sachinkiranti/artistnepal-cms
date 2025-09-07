module.exports = {
    getCsrfToken: function () {
        return $('meta[name="csrf-token"]').attr('content');
    },

    getAssetPath: function () {
        return $('meta[name="asset-path"]').attr('content') + '/';
    },

    getRootPath: function () {
        return $('meta[name="root-path"]').attr('content') + '/';
    },

    http: {
        get: function (url , data) {
            return this.ajax('GET', url, data);
        },

        post: function (url , data) {
            return this.ajax('POST', url, { ...{ _token: $('meta[name="csrf-token"]').attr('content') }, ...data });
        },

        ajax: function (type, url, data) {
            return $.ajax({
                type: type,
                url: url,
                data: data
            });
        }
    },

    toast: function (message) {
        toastr.success(message, '', {timer: 5000});
    },

    getImagePath: function (path) {
        return this.getAssetPath() + 'img/' + path;
    },

    fileExists: function (url) {
        var http = new XMLHttpRequest();

        http.open('HEAD', url, false);
        http.send();

        return http.status !== 404;
    },

    reload: function (timer) {
        setTimeout(function () {
            location.reload();
        }, timer || 3000);
    },

    location: function (path) {
        location.href = path;
    }
};
