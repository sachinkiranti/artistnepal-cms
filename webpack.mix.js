const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/dist/js')
    .sass('resources/sass/app.scss', 'public/dist/css');

mix.styles([
    'resources/assets/css/font-awesome.min.css',
    'resources/assets/css/animate.css',
    'resources/assets/css/plugins/sweetalert2/sweetalert2.min.css',
    'resources/assets/css/sweetalert.css',
    'resources/assets/css/plugins/toastr/toastr.min.css',
    'resources/assets/css/plugins/ladda/ladda-themeless.min.css',
    'resources/assets/js/plugins/x-editable/bootstrap-editable.css',
    'resources/assets/css/style.css'
], 'public/dist/css/backend.css');

mix.scripts([
    'resources/assets/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/assets/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/assets/js/inspinia.js',
    'resources/assets/js/plugins/pace/pace.min.js',
    'resources/assets/js/plugins/sweetalert2/sweetalert2.min.js',
    'resources/assets/js/sweetalert.min.js',
    'resources/assets/js/plugins/toastr/toastr.min.js',
    'resources/assets/js/plugins/ladda/spin.min.js',
    'resources/assets/js/plugins/ladda/ladda.min.js',
    'resources/assets/js/plugins/ladda/ladda.jquery.min.js',
    'resources/assets/js/plugins/x-editable/bootstrap-editable.min.js',
], 'public/dist/js/backend.js');

mix.styles([
    'resources/assets/css/plugins/dataTables/datatables.min.css',
    'resources/assets/css/plugins/iCheck/iCheck.css',
    'resources/assets/css/plugins/select2/select2.min.css',
    'resources/assets/css/plugins/dropify/dropify.min.css',
    'resources/assets/css/vendor.css',
], 'public/dist/css/plugin.css');

mix.scripts([
    'resources/assets/js/plugins/dataTables/datatables.min.js',
    'resources/assets/js/plugins/dataTables/dataTables.bootstrap4.min.js',
    'resources/assets/js/plugins/dataTables/buttons.colVis.min.js',
    'resources/assets/js/jquery-validate-1-19-1.js',
    'resources/assets/js/plugins/iCheck/icheck.min.js',
    'resources/assets/js/plugins/dropify/dropify.min.js',
    'resources/assets/js/plugins/select2/select2.full.min.js',
    'resources/assets/js/vendor.js',
], 'public/dist/js/plugin.js');

mix.styles([
    'resources/assets/css/list.css'
], 'public/dist/css/list.css');

mix.scripts([
    'resources/assets/js/list.js'
], 'public/dist/js/list.js');

mix.scripts([
    'resources/assets/js/show.js'
], 'public/dist/js/show.js');

mix.styles([
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.css',
], 'public/dist/css/jquery-ui.css');

mix.scripts([
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.js',
    // 'resources/assets/js/wizard.js',
], 'public/dist/js/jquery-ui.js');

mix.styles([
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.css',
    'resources/assets/css/menu-builder.css'
], 'public/dist/css/menu-builder.css');

mix.scripts([
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.js',
    'resources/assets/js/jquery.multisortable.js',
    'resources/assets/js/menu-builder.js',
], 'public/dist/js/menu-builder.js');

mix.styles([
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.css',
    'resources/assets/css/component-wrapper-builder.css'
], 'public/dist/css/component-wrapper-builder.css');

mix.scripts([
    'resources/assets/js/plugins/jquery-ui/jquery-ui.min.js',
    'resources/assets/js/jquery.multisortable.js',
    'resources/assets/js/component-wrapper-builder.js',
], 'public/dist/js/component-wrapper-builder.js');

mix.scripts([
    'public/vendor/laravel-filemanager/js/stand-alone-button.js',
    'resources/assets/js/widget-manager.js',
], 'public/dist/js/widget-manager.js');

mix.scripts([
    // 'public/vendor/laravel-filemanager/js/stand-alone-button.js',
    'resources/assets/js/advertisement-manager.js',
], 'public/dist/js/advertisement-manager.js');

mix.scripts([
    'public/vendor/laravel-filemanager/js/stand-alone-button.js',
    'resources/assets/js/gallery-manager.js',
], 'public/dist/js/gallery-manager.js');

mix.scripts([
    'public/vendor/laravel-filemanager/js/stand-alone-button.js',
    'resources/assets/js/post-gallery-manager.js',
], 'public/dist/js/post-gallery-manager.js');

mix.scripts([
    'resources/assets/js/post-manager.js',
], 'public/dist/js/post-manager.js');

mix.scripts([
    'resources/assets/js/client.min.js',
], 'public/dist/js/comment-manager.js');

require('./resources/themes/default/webpack.mix.js');

require('./resources/themes/artist-nepal/webpack.mix.js');
require('./resources/themes/artist-nepal/webpack.mix.js');
