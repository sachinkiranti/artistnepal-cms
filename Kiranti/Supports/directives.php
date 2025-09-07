<?php

return [

    # Usage : @hasaccess('create|read') @endhasaccess
    'hasaccess' => function ($arguments) {
        list($accesses, $guard) = explode(',', $arguments.',');

        $accesses = explode('|', str_replace('\'', '', $accesses));

        $expression = "<?php if(auth({$guard})->check() && ( false ";
        foreach ($accesses as $access) {
            $expression .= " || auth({$guard})->user()->can('{$access}')";
        }

        return $expression . ")): ?>";
    },

    'endhasaccess' => function ($arguments) {
        return '<?php endif; ?>';
    },

    'isurl' => function ($arguments) {
        list($urls, $guard) = explode(',', $arguments.',');

        $urls = explode('|', str_replace('\'', '', $urls));

        $urls = "'" . implode ( "', '", $urls ) . "'";

        return "<?php if(request()->is({$urls})) : ?>";
    },

    'endisurl' => function ($arguments) {
        return '<?php endif; ?>';
    },

    'website' => function ($expression) {
        return app(\Foundation\Handlers\Meta::class)
            ->handler(trim($expression, "\'\""));
    }

];
