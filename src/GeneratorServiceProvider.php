<?php

namespace LaraIO\Generator;

use Illuminate\Support\ServiceProvider;
use LaraIO\Core\Support\Core\ServicePackage;
use LaraIO\Core\Traits\WithServiceProvider;

class GeneratorServiceProvider extends ServiceProvider
{
    use WithServiceProvider;

    public function configurePackage(ServicePackage $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         */
        $package
            ->name('generator')
            ->hasConfigFile()
            ->hasViews()
            ->hasHelpers()
            ->hasAssets()
            ->hasTranslations()
            ->runsMigrations()
            ->hasRoutes('web');
    }
    public function extending()
    {
        add_filter('filter_table_option_plugin', function ($prev) {
            if (function_exists('Plugins_Test3_Hello'))
                Plugins_Test3_Hello();
            return $prev;
        });
        add_filter('filter_table_option_module', function ($prev) {
            $prev['action']['append'] = [
                ...$prev['action']['append'],
                [
                    'title' => 'generator::module.action.createFile',
                    'icon' => '<i class="bi bi-magic"></i>',
                    'class' => 'btn-primary',
                    'type' => 'update',
                    'action' => function ($module) {
                        return 'wire:component="generator::module.create-file({\'module\':\'' . $module . '\'})"';
                    }
                ], [
                    'title' => 'generator::module.action.create',
                    'icon' => '<i class="bi bi-magic"></i>',
                    'class' => 'btn-primary',
                    'permission' => 'core.permission',
                    'type' => 'new',
                    'action' => function () {
                        return 'wire:component="generator::module.create()"';
                    }
                ]
            ];
            return $prev;
        });
        // add_filter('router_admin_prefix', function () {
        //     return '/quan-ly';
        // });
    }
    public function registerMenu()
    {
    }
    public function packageRegistered()
    {
        add_link_symbolic(__DIR__ . '/../public', public_path('modules/generator'));
        add_asset_js(asset('modules/generator/js/generator.js'), '', 0);
        add_asset_css(asset('modules/generator/css/generator.css'), '',  0);

        $this->registerMenu();
        $this->extending();
    }
    private function bootGate()
    {
        if (!$this->app->runningInConsole()) {
            add_filter('permission_custom', function ($prev) {
                return [
                    ...$prev
                ];
            });
        }
    }
    public function packageBooted()
    {
        $this->bootGate();
    }
}
