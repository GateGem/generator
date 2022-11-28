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
                'index-html',
                'scaffold/config',
                'views/index',
                'assets/js/app',
                'assets/sass/app',
                'webpack',
                'package'
            ],
            'module' => [
                'routes/web',
                'routes/api',
                'composer',
                'provider-base',
                'json'
            ],
            'theme' => [
                'function',
                'layout',
                'layout-none',
                'json-function'
            ],
            'plugin' => [
                'function',
                'json-function'
            ]
        ],
        'templates' => [
            'index-html' => [
                'path' => 'public',
                'name' => 'index.html'
            ],
            'scaffold/config' => [
                'path' => 'config',
                'name' => '$LOWER_NAME$.php',
                'replacements' => [
                    'LOWER_NAME'
                ]
            ],
            'views/index' => [
                'path' => 'views',
                'name' => 'index.blade.php'
            ],
            'layout' => [
                'path' => 'views',
                'name' => 'layout.blade.php'
            ],
            'layout-none' => [
                'path' => 'views',
                'name' => 'none.blade.php'
            ],
            'assets/js/app' => [
                'path' => 'assets',
                'name' => 'js/app.js'
            ],
            'assets/sass/app' => [
                'path' => 'assets',
                'name' => 'sass/app.scss'
            ],
            'routes/web' => [
                'path' => 'routes',
                'name' => 'web.php',
                'replacements' => ['LOWER_NAME', 'STUDLY_NAME']
            ],
            'routes/api' =>  [
                'path' => 'routes',
                'name' => 'api.php',
                'replacements' => ['LOWER_NAME']
            ],
            'provider-base' => [
                'path' => 'src',
                'name' => '$STUDLY_NAME$ServiceProvider.php',
                'replacements' => ['LOWER_NAME', 'NAMESPACE', 'STUDLY_NAME']
            ],
            'composer' => [
                'name' => 'composer.json',
                'doblue' => true,
                'replacements' => [
                    'LOWER_NAME',
                    'STUDLY_NAME',
                    'VENDOR',
                    'AUTHOR_NAME',
                    'AUTHOR_EMAIL',
                    'NAMESPACE',
                    'BASE_TYPE_LOWER_NAME'
                ]
            ],
            'webpack' => [
                'name' => 'webpack.mix.js',
                'replacements' => [
                    'LOWER_NAME'
                ]
            ],
            'package' => [
                'name' => 'package.json',
                'replacements' => [
                    'LOWER_NAME'
                ]
            ],
            'function' => [
                'name' => 'function.php',
                'replacements' => [
                    'BASE_TYPE_LOWER_NAME',
                    'STUDLY_NAME'
                ]
            ],
            'json' => [
                'name' => '$BASE_TYPE_LOWER_NAME$.json',
                'doblue' => true,
                'replacements' => [
                    'BASE_TYPE_LOWER_NAME',
                    'STUDLY_NAME',
                    'LOWER_NAME',
                    'NAMESPACE'
                ]
            ],
            'json-function' => [
                'name' => '$BASE_TYPE_LOWER_NAME$.json',
                'doblue' => true,
                'replacements' => [
                    'BASE_TYPE_LOWER_NAME',
                    'STUDLY_NAME',
                    'LOWER_NAME',
                    'NAMESPACE'
                ]
            ],
            'command' => [
                'path' => 'command',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'COMMAND_NAME',
                    'CLASS',
                    'NAMESPACE'
                ]
            ],
            'component-class' => [
                'path' => 'component-class',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'LOWER_NAME',
                    'CLASS',
                    'NAMESPACE',
                    'COMPONENT_NAME'
                ]
            ],
            'component-view' => [
                'path' => 'component-view',
                'name' => '$LOWER_CLASS$.blade.php',
                'replacements' => [
                    'LOWER_NAME',
                    'LOWER_CLASS',
                    'NAMESPACE',
                    'QUOTE'
                ]
            ],
            'controller-api' => [
                'path' => 'controller',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE'
                ]
            ],
            'controller-plain' => [
                'path' => 'controller',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE'
                ]
            ],

            'controller' => [
                'path' => 'controller',
                'file_prex' => 'Controller',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],

            'event' => [
                'path' => 'event',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],
            'factory' => [
                'path' => 'factory',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                    'MODEL_NAMESPACE'
                ]
            ],
            'job' => [
                'path' => 'job',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],
            'job-queued' => [
                'path' => 'job',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],

            'model' => [
                'path' => 'model',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],

            'listener' => [
                'path' => 'listener',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],

            'listener-queued' => [
                'path' => 'listener',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],

            'listener-queued-duck' => [
                'path' => 'listener',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],

            'listener-duck' => [
                'path' => 'listener',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME'
                ]
            ],
            'livewire' => [
                'path' => 'livewire',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                    'VIEW_NAME'
                ]
            ],

            'livewire-inline' => [
                'path' => 'livewire',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                    'QUOTE'
                ]
            ],
            'mail' => [
                'path' => 'emails',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'middleware' => [
                'path' => 'middleware',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],

            'notification' => [
                'path' => 'notifications',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'policy-plain' => [
                'path' => 'policies',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'provider' => [
                'path' => 'provider',
                'file_prex' => 'ServiceProvider',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'scaffold/provider' => [
                'path' => 'provider',
                'file_prex' => 'ServiceProvider',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'route-provider' => [
                'path' => 'provider',
                'file_prex' => 'ServiceProvider',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'request' => [
                'path' => 'request',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'resource' => [
                'path' => 'resource',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'resource-collection' => [
                'path' => 'resource',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'rule' => [
                'path' => 'rules',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
            'seeder' => [
                'path' => 'seeder',
                'name' => '$CLASS_FILE$.php',
                'replacements' => [
                    'CLASS',
                    'NAMESPACE',
                    'LOWER_NAME',
                ]
            ],
        ],
        'gitkeep' => true,
    ],
    'paths' => [
        'base' => ['path' => '', 'namespace' => '', 'generate' => false],
        'src' => ['path' => 'src', 'namespace' => '', 'generate' => false],
        'config' => ['path' => 'config', 'generate' => true, 'only' => ['module']],
        'command' => ['path' => 'src/Console/Commands', 'namespace' => 'Console\\Commands', 'generate' => true, 'only' => ['module']],
        'migration' => ['path' => 'Database/Migrations', 'namespace' => 'Database\\Migrations', 'generate' => true, 'only' => ['module']],
        'seeder' => ['path' => 'Database/Seeders', 'namespace' => 'Database\\Seeders', 'generate' => true, 'only' => ['module']],
        'factory' => ['path' => 'Database/factories', 'namespace' => 'Database\\Factories', 'generate' => true, 'only' => ['module']],
        'model' => ['path' => 'src/Models', 'namespace' => 'Models', 'generate' => true, 'only' => ['module']],
        'routes' => ['path' => 'routes', 'generate' => true, 'only' => ['module']],
        'controller' => ['path' => 'src/Http/Controllers', 'namespace' => 'Http\\Controllers', 'generate' => true, 'only' => ['module']],
        'livewire' => ['path' => 'src/Http/Livewire', 'namespace' => 'Http\\Livewire', 'generate' => true, 'only' => ['module']],
        'middleware' => ['path' => 'src/Http/Middleware', 'namespace' => 'Http\\Middleware', 'generate' => true, 'only' => ['module']],
        'request' => ['path' => 'src/Http/Requests', 'namespace' => 'Http\\Requests', 'generate' => true, 'only' => ['module']],
        'provider' => ['path' => 'src/Providers', 'namespace' => 'Providers', 'generate' => true, 'only' => ['module']],
        'assets' => ['path' => 'resources/assets', 'generate' => true],
        'lang' => ['path' => 'resources/lang', 'generate' => true],
        'views' => ['path' => 'resources/views', 'generate' => true],
        'public' => ['path' => 'public', 'generate' => true],
        'test' => ['path' => 'Tests/Unit', 'namespace' => 'Tests\\Unit', 'generate' => true, 'only' => ['module']],
        'test-feature' => ['path' => 'Tests/Feature', 'namespace' => 'Feature', 'generate' => true, 'only' => ['module']],
        'repository' => ['path' => 'src/Repositories', 'namespace' => 'Repositories', 'generate' => false, 'only' => ['module']],
        'event' => ['path' => 'src/Events', 'namespace' => 'Events', 'generate' => false, 'only' => ['module']],
        'listener' => ['path' => 'src/Listeners', 'namespace' => 'Listeners', 'generate' => false, 'only' => ['module']],
        'policies' => ['path' => 'src/Policies', 'namespace' => 'Policies', 'generate' => false, 'only' => ['module']],
        'rules' => ['path' => 'src/Rules', 'namespace' => 'Rules', 'generate' => false, 'only' => ['module']],
        'jobs' => ['path' => 'src/Jobs', 'namespace' => 'Jobs', 'generate' => false, 'only' => ['module']],
        'emails' => ['path' => 'src/Emails', 'namespace' => 'Emails', 'generate' => false, 'only' => ['module']],
        'notifications' => ['path' => 'src/Notifications', 'namespace' => 'Notifications', 'generate' => false, 'only' => ['module']],
        'resource' => ['path' => 'src/Transformers', 'namespace' => 'Transformers', 'generate' => false, 'only' => ['module']],
        'component-view' => ['path' => 'resources/views/components', 'generate' => false, 'only' => ['module']],
        'component-class' => ['path' => 'src/View/Components', 'namespace' => 'View\\Components', 'generate' => false, 'only' => ['module']],
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
        // Commands\Module\ModelMakeCommand::class,
        // Commands\Module\SeedCommand::class,
        Commands\Module\SeedMakeCommand::class,
        Commands\Module\UnUseCommand::class,
        Commands\Module\UpdateCommand::class,
        Commands\Module\UseCommand::class,
        Commands\Module\ResourceMakeCommand::class,

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
];
