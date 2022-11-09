<?php

namespace LaraPlatform\Generator;

use Illuminate\Support\ServiceProvider;
use LaraPlatform\Core\Supports\ServicePackage;
use LaraPlatform\Core\Traits\WithServiceProvider;

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
