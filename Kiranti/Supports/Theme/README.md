# Theme Installation

- Load helpers and add namespace 
````
"files": [
            "Kiranti/helpers.php"
        ],
        "psr-4": {
            "App\\": "app/",
            "Kiranti\\": "Kiranti/",
        },
````

- Add Helpers functions
````
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
    function theme_asset($path) {
        return \Kiranti\Supports\Theme\Theme::asset($path);
    }

endif;
````

- Register the serviceProviders in function

`use Kiranti\Supports\Theme\Provider as ThemeServiceProvider;`

`$this->app->registerDeferredProvider(ThemeServiceProvider::class)`

- Make a Kiranti Lib

````
<?php

namespace Kiranti\Lib;

/**
 * Class Kiranti
 * @package Kiranti\Lib
 */
final class Kiranti
{

    const LANGUAGE_KEY = 'Kiranti-lang';
    const THEME_KEY = 'theme';

}

````

- Activate Theme [ ServiceProvider Register ]

````
$this->app['theme']->init(active_theme());
````

- Helpers

````
app('theme')->all() // Return all available theme
theme_path() // Return the theme path
active_theme() // Return the active theme
theme_asset() // Theme asset
````

#### USAGE

- We have commands :
    - Generate Theme `php artisan theme:generate themename` [  N/A ]
    - List Theme `php artisan theme:list` 
    - Edit Theme `php artisan theme:edit themename`
    - Destroy Theme [  N/A ]

####  Issues

- Language
- Assets [ Not Tested ]
