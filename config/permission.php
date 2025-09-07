<?php

return [

    # Class for the permission table .
    'table' => \Foundation\Models\Permission::class,

    # Class for the role table .
    'role_table' => \Foundation\Models\Role::class,

    # These array will be ignore while generating permissions .
    'ignored_routes' => [
        'home',
        'login',
        'logout',
        'register',
        'password.request',
        'password.email',
        'password.reset',
        'password.update',
        'password.confirm',
    ],

    # This will be used to glue the permission replacing black-listed-chars .
    'glue' => '_',

    # This will be black listed and replaced using glue (.) .
    'black-listed-chars' => [ '.', ],

];
