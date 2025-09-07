<?php

if (! function_exists('flash') ) :

    function flash($type, $message)
    {
        return app(\Kiranti\Lib\Flash::class)->notify($type, $message);
    }

endif;

if (! function_exists('is_active') ) :

    /**
     * Check if given route is active
     *
     * @return boolean
     */
    function is_active(string $route)
    {
        return request()->route()->getName() === $route;
    }

endif;

if (! function_exists('is_json')) :

    function is_json($string){
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

endif;

if (!  function_exists('toaster') ) :

    function toaster()
    {
        if (session()->has('notify')) {
            $type = session()->get('notify.type');
            $response = session('notify.response');
            $title = '';
            $options = json_encode([
                'closeButton'       => true,
                'closeClass'        => 'toast-close-button',
                'closeDuration'     => 300,
                'closeEasing'       => 'swing',
                'closeHtml'         => '<button><i class="icon-off"></i></button>',
                'closeMethod'       => 'fadeOut',
                'closeOnHover'      => true,
                'containerId'       => 'toast-container',
                'debug'             => false,
                'escapeHtml'        => false,
                'extendedTimeOut'   => 10000,
                'hideDuration'      => 1000,
                'hideEasing'        => 'linear',
                'hideMethod'        => 'fadeOut',
                'iconClass'         => 'toast-info',
                'iconClasses'       => [
                    'error'   => 'toast-error',
                    'info'    => 'toast-info',
                    'success' => 'toast-success',
                    'warning' => 'toast-warning',
                ],
                'messageClass'      => 'toast-message',
                'newestOnTop'       => false,
                'onHidden'          => null,
                'onShown'           => null,
                'positionClass'     => 'toast-top-right',
                'preventDuplicates' => true,
                'progressBar'       => true,
                'progressClass'     => 'toast-progress',
                'rtl'               => false,
                'showDuration'      => 300,
                'showEasing'        => 'swing',
                'showMethod'        => 'fadeIn',
                'tapToDismiss'      => true,
                'target'            => 'body',
                'timeOut'           => 5000,
                'titleClass'        => 'toast-title',
                'toastClass'        => 'toast',
            ]);
            return "toastr.$type('$response', '$title', $options);";
        }
    }

endif;

if (! function_exists('theme_path') ) :

    /**
     * Get the path to the themes directory.
     *
     * @param  string  $path
     * @return string
     */
    function theme_path ($path = '') {
        return app()->resourcePath('themes'.($path ? DIRECTORY_SEPARATOR.$path : $path));
    }

endif;

if (! function_exists('active_lang') ) :

    /**
     * Get the active language
     *
     * @param  string  $path
     * @return string
     */
    function active_lang () {
        return request('lang') ?? session(\Kiranti\Config\Language::LANG_KEY, 'np');
    }

endif;

if (! function_exists('active_theme') ) :

    /**
     * Get the active theme
     *
     * @param  string  $path
     * @return string
     */
    function active_theme () {
        return \Kiranti\Supports\Theme\Theme::active();
    }

endif;

if (! function_exists('theme_asset') ) :

    /**
     * Get the active theme asset path
     *
     * @param  string  $path
     * @return string
     */
    function theme_asset($path = '/') {
        return \Kiranti\Supports\Theme\Theme::asset($path);
    }

endif;

if (! function_exists('_x') ) :

    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function _x($key = null, $replace = [], $locale = null) {
        return trans(\Kiranti\Supports\Theme\Theme::active(). '::'. $key, $replace, $locale);
    }

endif;

if (! function_exists('array_get')) :

    function array_get($data, $key) {
        return \Illuminate\Support\Arr::get($data, $key);
    }

endif;

if (! function_exists('resolve_description')) :

    function resolve_description($description, $limit = 100, $readMore = ' ...') {
        return \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($description)), $limit, $readMore) ?? '';
    }

endif;

if (! function_exists('author_url')) :

    function author_url($url) {
        return route('author.single', [
            'author' => $url,
        ]);
    }

endif;

if (! function_exists('gravatar_image_url')) :

    function gravatar_image_url($email, $image = null) {
        if ($email) {

            if ($image) {
                $full_path = public_path("{$image}");
                if (file_exists($full_path) || !empty($image)) {
                    return asset($image);
                }
            }

            $gravatar_img_src = 'http://www.gravatar.com/avatar/' . md5($email) . '?s=32';
            return $gravatar_img_src;
        }
    }

endif;


if (! function_exists('resolve_image')) :

    function resolve_image($imagePath, $identifier = null, $publicPath = '/images/posts/') {
        if (file_exists( public_path('/images/news/' . $identifier . '/' . $imagePath))) {
            return '/images/news/'. $identifier . '/' . $imagePath;
        }

        if (file_exists( public_path('storage' .$publicPath .$imagePath))) {
            return asset('storage' .$publicPath .$imagePath);
        }
        return asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('logo'));
    }

endif;

if (! function_exists('get_thumbnail')) :

    function get_thumbnail($imagePath, $identifier = null, $publicPath = '/images/posts/') {

        $thumbnailPath = 'thumbs/400_400_' . $imagePath;

        if (file_exists( public_path('storage/images/posts/' .$thumbnailPath))) {
            return asset('storage/images/posts/' .$thumbnailPath);
        }

        if (file_exists( public_path('/images/news/' . $identifier . '/' . $imagePath))) {
            return '/images/news/'. $identifier . '/' . $imagePath;
        }

        if (file_exists( public_path('storage' .$publicPath .$imagePath))) {
            return asset('storage' .$publicPath .$imagePath);
        }
        return asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('logo'));
    }

endif;

if (! function_exists('resolve_thumb')) :

    function resolve_thumb(\Illuminate\Database\Eloquent\Model $model, $column = 'image') {
        $imagePath = 'thumbs/200_200_' . $model->{$column};
        if (file_exists( public_path('storage/images/posts/' .$imagePath))) {
            return asset('storage/images/posts/' .$imagePath);
        }

        return asset( 'storage/images/setting/'.\Foundation\Builders\Cache\Meta::get('logo'));
    }

endif;

if (! function_exists('date_by_lang')) :

    function date_by_lang($date) {

        if (active_lang() === 'np') {
            return \Kiranti\Lib\Date::convert(
                $date->format('Y'),
                $date->format('m'),
                $date->format('d')
            );
        }

    }

endif;

if (! function_exists('database_size') ) :

    function database_size() {
        $tableName = config('database.connections.mysql.database');
        $sqlQuery = "SELECT table_schema '$tableName', SUM( data_length + index_length) / 1024 / 1024 'db_size_in_mb' FROM information_schema.TABLES WHERE table_schema='$tableName' GROUP BY table_schema;";

        $result = app('db')->select($sqlQuery);

        return isset($result[0]->db_size_in_mb) ? $result[0]->db_size_in_mb : 0;
    }

endif;

if (! function_exists('log_file_size') ) :

    function log_file_size() {
        $size = 0;
        foreach (glob(storage_path('logs/*.log')) as $log) {
            $size += filesize($log);
        }

        if ($size >= 1073741824)
        {
            $size = number_format($size / 1073741824, 2) . ' GB';
        }
        elseif ($size >= 1048576)
        {
            $size = number_format($size / 1048576, 2) . ' MB';
        }
        elseif ($size >= 1024)
        {
            $size = number_format($size / 1024, 2) . ' KB';
        }
        elseif ($size > 1)
        {
            $size = $size . ' bytes';
        }
        elseif ($size == 1)
        {
            $size = $size . ' byte';
        }
        else
        {
            $size = '0 bytes';
        }

        return $size;
    }

endif;
