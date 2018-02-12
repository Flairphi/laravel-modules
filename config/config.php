<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Modules',

    /*
    |--------------------------------------------------------------------------
    | Entity Generator
    |--------------------------------------------------------------------------
    |
    | Module Entity Generator
    |
    */

    'generator' => [
        'models' => [
            'module_prefix'        => true,
            'use_binary_uuid'      => true,
            'primary_key'          => "id",
            'trait_name'           => "HasBinaryUuid",
            'trait_namespace'      => "Spatie\BinaryUuid\HasBinaryUuid"
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Tenancy Support
    |--------------------------------------------------------------------------
    |
    | Enabling Laravel Tenancy
    |
    */

    'tenancy' => [
        'enabled'  => false,
        'paths' => [
            'modules' => [
                'system' => 'system',
                'tenant' => 'tenant',
            ],
            'migrations'  => base_path('database/migrations/tenant'),
        ],
        'models'        => [
            'connection_type' => true,
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => false,
        'path' => base_path() . '/vendor/flairphi/laravel-modules/src/Commands/stubs',
        'files' => [
            'start'             => 'start.php',
            'routes/web'        => 'Routes/web.php',
            'routes/api'        => 'Routes/api.php',
            'views/index'       => 'Resources/views/index.blade.php',
            'views/master'      => 'Resources/views/layouts/master.blade.php',
            'scaffold/config'   => 'Config/config.php',
            'composer'          => 'composer.json',
        ],
        'replacements' => [
            'start'             => ['LOWER_NAME', 'ROUTES_WEB_LOCATION','ROUTES_API_LOCATION'],
            'routes/web'        => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'routes/api'        => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'json'              => ['LOWER_NAME', 'MODULE_TYPE', 'STUDLY_NAME', 'MODULE_NAMESPACE'],
            'views/index'       => ['LOWER_NAME'],
            'views/master'      => ['STUDLY_NAME'],
            'scaffold/config'   => ['STUDLY_NAME','MODULE_TYPE'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
                'MODULE_TYPE'
            ],
        ],
        'gitkeep' => true,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
        */

        'modules' => base_path('Modules'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules assets path.
        |
        */

        'assets' => public_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | The migrations path
        |--------------------------------------------------------------------------
        |
        | Where you run 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),

        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
        */
        'generator' => [
            'config' => ['path' => 'Config', 'generate' => true],
            'command' => ['path' => 'Console', 'generate' => true],
            'migration' => ['path' => 'Database/Migrations', 'generate' => true],
            'seeder' => ['path' => 'Database/Seeders', 'generate' => true],
            'factory' => ['path' => 'Database/factories', 'generate' => true],
            'model' => ['path' => 'Models', 'generate' => true],
            'trait' => ['path' => 'Traits', 'generate' => true],
            'support' => ['path' => 'Support', 'generate' => true],
            'controller' => ['path' => 'Http/Controllers', 'generate' => true],
            'filter' => ['path' => 'Http/Middleware', 'generate' => true],
            'request' => ['path' => 'Http/Requests', 'generate' => true],
            'provider' => ['path' => 'Providers', 'generate' => true],
            'assets' => ['path' => 'Resources/assets', 'generate' => true],
            'lang' => ['path' => 'Resources/lang', 'generate' => true],
            'views' => ['path' => 'Resources/views', 'generate' => true],
            'test' => ['path' => 'Tests', 'generate' => true],
            'repository' => ['path' => 'Repositories', 'generate' => true],
            'contact'=>['path'=>'Contacts','generate'=>true],
            'event' => ['path' => 'Events', 'generate' => true],
            'listener' => ['path' => 'Listeners', 'generate' => true],
            'policies' => ['path' => 'Policies', 'generate' => true],
            'rules' => ['path' => 'Rules', 'generate' => true],
            'jobs' => ['path' => 'Jobs', 'generate' => true],
            'emails' => ['path' => 'Emails', 'generate' => true],
            'notifications' => ['path' => 'Notifications', 'generate' => true],
            'resource' => ['path' => 'Transformers', 'generate' => true],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'flairphi',
        'author' => [
            'name' => 'Sharif Adan',
            'email' => 'hello@sharif.co',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],
];
