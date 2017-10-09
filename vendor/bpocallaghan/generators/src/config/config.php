<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The singular resource words that will not be pluralized
    | For Example: $ php artisan generate:resource admin.bar
    | The url will be /admin/bars and not /admins/bars
    |--------------------------------------------------------------------------
    */

    'reserve_words' => ['app', 'website', 'admin'],

    /*
    |--------------------------------------------------------------------------
    | The default keys and values for the settings of each type to be generated
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'namespace'           => '',
        'path'                => './app/',
        'prefix'              => '',
        'postfix'             => '',
        'file_type'           => '.php',
        'dump_autoload'       => false,
        'directory_format'    => '',
        'directory_namespace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Types of files that can be generated
    |--------------------------------------------------------------------------
    */

    'settings' => [
        'view'         => [
            'path'                => './resources/views/',
            'file_type'           => '.blade.php',
            'directory_format'    => 'strtolower',
            'directory_namespace' => true
        ],
        'model'        => ['namespace' => '\Models', 'path' => './app/Models/'],
        'controller'   => [
            'namespace'           => '\Http\Controllers',
            'path'                => './app/Http/Controllers/',
            'postfix'             => 'Controller',
            'directory_namespace' => true,
            'dump_autoload'       => true,
            'repository_contract' => false,
        ],
        'seed'         => ['path' => './database/seeds/', 'postfix' => 'TableSeeder'],
        'migration'    => ['path' => './database/migrations/'],
        'notification' => [
            'directory_namespace' => true,
            'namespace'           => '\Notifications',
            'path'                => './app/Notifications/'
        ],
        'event'        => [
            'directory_namespace' => true,
            'namespace'           => '\Events',
            'path'                => './app/Events/'
        ],
        'listener'     => [
            'directory_namespace' => true,
            'namespace'           => '\Listeners',
            'path'                => './app/Listeners/'
        ],
        'trait'        => [
            'directory_namespace' => true,
        ],
        'job'          => [
            'directory_namespace' => true,
            'namespace'           => '\Jobs',
            'path'                => './app/Jobs/'
        ],
        'console'      => [
            'directory_namespace' => true,
            'namespace'           => '\Console\Commands',
            'path'                => './app/Console/Commands/'
        ],
        'middleware'   => [
            'directory_namespace' => true,
            'namespace'           => '\Http\Middleware',
            'path'                => './app/Http/Middleware/'
        ],
        'repository'   => [
            'directory_namespace' => true,
            'postfix'             => 'Repository',
            'namespace'           => '\Repositories',
            'path'                => './app/Repositories/'
        ],
        'contract'     => [
            'directory_namespace' => true,
            'namespace'           => '\Contracts',
            'postfix'             => 'Repository',
            'path'                => './app/Contracts/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resource Views [stub_key | name of the file]
    |--------------------------------------------------------------------------
    */

    'resource_views' => [
        'view_index'       => 'index',
        //'view_create'      => 'create',
        //'view_edit'        => 'edit',
        'view_show'        => 'show',
        'view_create_edit' => 'create_edit',
    ],

    /*
    |--------------------------------------------------------------------------
    | Where the stubs for the generators are stored
    |--------------------------------------------------------------------------
    */

    'example_stub'                => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/example.stub',
    'model_stub'                  => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/model.stub',
    'model_plain_stub'            => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/model.plain.stub',
    'migration_stub'              => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/migration.stub',
    'migration_plain_stub'        => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/migration.plain.stub',
    'controller_stub'             => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/controller.stub',
    'controller_plain_stub'       => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/controller.plain.stub',
    'controller_repository_stub'  => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/controller_repository.stub',
    'pivot_stub'                  => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/pivot.stub',
    'seed_stub'                   => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/seed.stub',
    'seed_plain_stub'             => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/seed.plain.stub',
    'view_stub'                   => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/view.stub',
    'view_index_stub'             => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/view.index.stub',
    'view_show_stub'              => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/view.show.stub',
    //'view_create_stub'            => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/view.create.stub',
    //'view_edit_stub'              => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/view.edit.stub',
    'view_create_edit_stub'       => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/view.create_edit.stub',
    'schema_create_stub'          => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/schema-create.stub',
    'schema_change_stub'          => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/schema-change.stub',
    'notification_stub'           => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/notification.stub',
    'event_stub'                  => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/event.stub',
    'listener_stub'               => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/listener.stub',
    'many_many_relationship_stub' => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/many_many_relationship.stub',
    'trait_stub'                  => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/trait.stub',
    'job_stub'                    => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/job.stub',
    'console_stub'                => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/console.stub',
    'middleware_stub'             => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/middleware.stub',
    'repository_stub'             => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/repository.stub',
    'contract_stub'               => base_path() . '/vendor/bpocallaghan/generators/resources/stubs/contract.stub',
];
