<?php

/**
 * Kiranti Configurations
 * @version 0.1.0
 */

return [

    'root_path' => app_path('Foundation'),

    /*
    |--------------------------------------------------------------------------
    | Generator path configurations
    |--------------------------------------------------------------------------
    |
    | Where to generate the given entity
    |
    */
    'controller_namespace' => 'Admin',
    'api_controller_namespace' => 'Api',
    'path' => [
        'controller_path' => app_path('Http/Controllers/Admin/'),
        'model_path' => 'Models/',
        'view_path' => 'Services/',
        'service_path' => 'Services/',
        'request_path' => 'Requests/',
        'api_controller_path' => app_path('Http/Controllers/Api/'),
        'api_resource_path' => 'Resources/'
    ],

    /*
    |--------------------------------------------------------------------------
    | Stubs path configurations
    |--------------------------------------------------------------------------
    |
    | Stubs to be pulled in from
    |
    */
    'stub' => [
        'controller_stub_path' => '',
        'model_stub_path' => '',
        'view_stub_path' => '',
        'service_stub_path' => '',
        'request_stub_path' => '',
        'api_controller_stub_path' => '',
        'api_resource_stub_path'  => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Path configurations
    |--------------------------------------------------------------------------
    |
    | Don't create the full app base path
    |
    */
    'default_path' => [
        'api_controller_path',
        'controller_path',
    ],

    /*
    |--------------------------------------------------------------------------
    | Stubs path configurations
    |--------------------------------------------------------------------------
    |
    | Stubs to be pulled in from
    |
    */
    'base_view_path' => base_path('resources/views/admin'),

    'view_structures' => [
        'create' => 'create',
        'edit' => 'edit',
        'index' => 'index',
        'script' => 'partials/scripts',
        'form' => 'partials/form',
        'show' => 'show',
        'table' => 'partials/table',
    ],
];
