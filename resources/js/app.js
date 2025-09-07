require('./bootstrap');

// var Turbolinks = require("turbolinks");
// Turbolinks.start();

// document.addEventListener('turbolinks:before-render', () => {
//     Components.unloadAll();
// });
//
// document.addEventListener(
//     'turbolinks:load',
//     () => Components.loadAll(),
//     {
//         once: true,
//     },
// );
//
// document.addEventListener('turbolinks:render', () =>
//     Components.loadAll(),
// );

// $(document).on('ajax:before', '[data-remote]', () => {
//     Turbolinks.clearCache();
// });
//
// document.addEventListener('turbolinks:before-cache', () => {
//     // Manually tear down bootstrap modals before caching. If turbolinks
//     // caches the modal then tries to restore it, it breaks bootstrap's JS.
//     // We can't just use bootstrap's `modal('close')` method because it is async.
//     // Turbolinks will cache the page before it finishes running.
//     if (document.body.classList.contains('modal-open')) {
//         $('.modal')
//             .hide()
//             .removeAttr('aria-modal')
//             .attr('aria-hidden', 'true');
//         $('.modal-backdrop').remove();
//         $('body').removeClass('modal-open');
//     }
// });
