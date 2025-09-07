try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    window.router = require('../../../../js/route');
    window.utils  = require('../../../../js/utils');
} catch (e) {}
