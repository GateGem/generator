<?php

use LaraIO\Generator\FileActivator;
use LaraIO\Generator\Commands;

return [
    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => [
        'root' => 'LaraApp',
        'theme' => 'Themes',
        'module' => 'Modules',
        'plugin' => 'Plugins',
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
        'path' => base_path('vendor/laraio/generator/src/Commands/stubs'),
        'files' => [
            'common' => [
                'index-html' => 'public/index.html',
                'scaffold/config' => 'config/$LOWER_NAME$.php',
                'views/index' => 'resources/views/index.blade.php',
                'assets/js/app' => 'resources/assets/js/app.js',
                'assets/sass/app' => 'resources/assets/sass/app.scss',
                'webpack' => 'webpack.mix.js',
                'package' => 'package.json'
            ],
            'module' => [
                'routes/web' => 'routes/web.php',
                'routes/api' => 'routes/api.php',
                'composer' => 'composer.json',
                'provider-base' => 'src/$STUDLY_NAME$ServiceProvider.php',
            ],
            'theme' => [
                'function' => 'function.php'
            ],
            'plugin' => [
                'function' => 'function.php'
            ]
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME'],
            'routes/api' => ['LOWER_NAME'],
            'webpack' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'LARAAPP_NAMESPACE', 'PROVIDER_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME', 'LOWER_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'LARAAPP_NAMESPACE',
                'PROVIDER_NAMESPACE',
                'BASE_TYPE_NAME',
            ],
            'function' => ['BASE_TYPE_NAME', 'STUDLY_NAME'],
            'provider-base' => ['LOWER_NAME', 'NAMESPACE', 'STUDLY_NAME', 'LARAAPP_NAMESPACE', 'PROVIDER_NAMESPACE'],
            'index-html' => ['LOWER_NAME'],
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
            'config' => ['path' => 'config', 'generate' => true, 'only' => ['module']],
            'command' => ['path' => 'src/Console/Commands', 'generate' => true, 'only' => ['module']],
            'migration' => ['path' => 'Database/Migrations', 'generate' => true, 'only' => ['module']],
            'seeder' => ['path' => 'Database/Seeders', 'generate' => true, 'only' => ['module']],
            'factory' => ['path' => 'Database/factories', 'generate' => true, 'only' => ['module']],
            'model' => ['path' => 'src/Models', 'generate' => true, 'only' => ['module']],
            'routes' => ['path' => 'routes', 'generate' => true, 'only' => ['module']],
            'controller' => ['path' => 'src/Http/Controllers', 'generate' => true, 'only' => ['module']],
            'filter' => ['path' => 'src/Http/Middleware', 'generate' => true, 'only' => ['module']],
            'request' => ['path' => 'src/Http/Requests', 'generate' => true, 'only' => ['module']],
            'provider' => ['path' => 'src/Providers', 'generate' => true, 'only' => ['module']],
            'assets' => ['path' => 'resources/assets', 'generate' => true],
            'lang' => ['path' => 'resources/lang', 'generate' => true],
            'views' => ['path' => 'resources/views', 'generate' => true],
            'test' => ['path' => 'Tests/Unit', 'generate' => true, 'only' => ['module']],
            'test-feature' => ['path' => 'Tests/Feature', 'generate' => true, 'only' => ['module']],
            'repository' => ['path' => 'src/Repositories', 'generate' => false, 'only' => ['module']],
            'event' => ['path' => 'src/Events', 'generate' => false, 'only' => ['module']],
            'listener' => ['path' => 'src/Listeners', 'generate' => false, 'only' => ['module']],
            'policies' => ['path' => 'src/Policies', 'generate' => false, 'only' => ['module']],
            'rules' => ['path' => 'src/Rules', 'generate' => false, 'only' => ['module']],
            'jobs' => ['path' => 'src/Jobs', 'generate' => false, 'only' => ['module']],
            'emails' => ['path' => 'src/Emails', 'generate' => false, 'only' => ['module']],
            'notifications' => ['path' => 'src/Notifications', 'generate' => false, 'only' => ['module']],
            'resource' => ['path' => 'src/Transformers', 'generate' => false, 'only' => ['module']],
            'component-view' => ['path' => 'resources/views/components', 'generate' => false, 'only' => ['module']],
            'component-class' => ['path' => 'src/View/Components', 'generate' => false, 'only' => ['module']],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Package commands
    |--------------------------------------------------------------------------
    |
    | Here you can define which commands will be visible and used in your
    | application. If for example you don't use some of the commands provided
    | you can simply comment them out.
    |
    */
    'commands' => [
        Commands\ClearAllCache::class,
        Commands\Module\CommandMakeCommand::class,
        Commands\Module\ComponentClassMakeCommand::class,
        Commands\Module\ComponentViewMakeCommand::class,
        Commands\Module\ControllerMakeCommand::class,
        Commands\Module\DisableCommand::class,
        Commands\Module\DumpCommand::class,
        Commands\Module\EnableCommand::class,
        Commands\Module\EventMakeCommand::class,
        Commands\Module\JobMakeCommand::class,
        Commands\Module\ListenerMakeCommand::class,
        Commands\Module\LivewireMakeCommand::class,
        Commands\Module\MailMakeCommand::class,
        Commands\Module\MiddlewareMakeCommand::class,
        Commands\Module\NotificationMakeCommand::class,
        Commands\Module\ProviderMakeCommand::class,
        Commands\Module\RouteProviderMakeCommand::class,
        Commands\Module\ModuleDeleteCommand::class,
        Commands\Module\ModuleMakeCommand::class,
        Commands\Module\FactoryMakeCommand::class,
        Commands\Module\PolicyMakeCommand::class,
        Commands\Module\RequestMakeCommand::class,
        Commands\Module\RuleMakeCommand::class,
        Commands\Module\MigrateCommand::class,
        Commands\Module\MigrateRefreshCommand::class,
        Commands\Module\MigrateResetCommand::class,
        Commands\Module\MigrateRollbackCommand::class,
        Commands\Module\MigrateStatusCommand::class,
        Commands\Module\MigrationMakeCommand::class,
        Commands\Module\ModelMakeCommand::class,
        Commands\Module\PublishCommand::class,
        Commands\Module\PublishConfigurationCommand::class,
        Commands\Module\PublishMigrationCommand::class,
        Commands\Module\PublishTranslationCommand::class,
        Commands\Module\SeedCommand::class,
        Commands\Module\SeedMakeCommand::class,
        Commands\Module\UnUseCommand::class,
        Commands\Module\UpdateCommand::class,
        Commands\Module\UseCommand::class,
        Commands\Module\ResourceMakeCommand::class,
        Commands\Module\TestMakeCommand::class,

        Commands\Theme\ThemeDeleteCommand::class,
        Commands\Theme\ThemeMakeCommand::class,

        Commands\Plugin\PluginDeleteCommand::class,
        Commands\Plugin\PluginMakeCommand::class,
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
        'vendor' => 'laraio',
        'author' => [
            'name' => 'Nguyen Van Hau',
            'email' => 'nguyenvanhaudev@gmail.com',
        ],
        'composer-output' => false,
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
        'key' => 'generator',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what generator will register as custom namespaces.
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

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
    */
    'activators' => [
        'file' => [
            'class' => FileActivator::class,
            'statuses-file' => base_path('modules_statuses.json'),
            'cache-key' => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator' => 'file',
];
