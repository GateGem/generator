<?php

namespace GateGem\Generator;

use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Support\Config\ButtonConfig;
use GateGem\Core\Support\Config\ConfigManager;
use Illuminate\Support\ServiceProvider;
use GateGem\Core\Support\Core\ServicePackage;
use GateGem\Core\Traits\WithServiceProvider;
use Illuminate\Support\Facades\Log;

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
            ->runsMigrations();
    }
    public function extending()
    {
        add_filter('filter_table_option_module', function ($prev) {
            if (!isset($prev[ConfigManager::BUTTON_APPEND])) $prev[ConfigManager::BUTTON_APPEND] = [];
            $prev[ConfigManager::BUTTON_APPEND] = [
                ...$prev[ConfigManager::BUTTON_APPEND],
                GateConfig::Button('generator::module.action.createFile')
                    ->setIcon('<i class="bi bi-magic"></i>')
                    ->setClass('btn btn-sm btn-primary')
                    ->setPermission('core.module.generator.file')
                    ->setType(ButtonConfig::TYPE_UPDATE)
                    ->setDoComponent('generator::module.create-file', function ($module) {
                        return "{'module':'" . $module . "'}";
                    }),
                GateConfig::Button('generator::module.action.create')
                    ->setIcon('<i class="bi bi-magic"></i>')
                    ->setClass('btn btn-sm btn-primary')
                    ->setPermission('core.module.generator')
                    ->setType(ButtonConfig::TYPE_ADD)
                    ->setDoComponent('generator::module.create')

            ];
            return $prev;
        });
        add_filter('filter_table_option_plugin', function ($prev) {
            if (!isset($prev[ConfigManager::BUTTON_APPEND])) $prev[ConfigManager::BUTTON_APPEND] = [];
            $prev[ConfigManager::BUTTON_APPEND] = [
                ...$prev[ConfigManager::BUTTON_APPEND],
                // GateConfig::Button('generator::plugin.action.createFile')
                //     ->setIcon('<i class="bi bi-magic"></i>')
                //     ->setClass('btn btn-sm btn-primary')
                //     ->setPermission('core.plugin.generator.file')
                //     ->setType(ButtonConfig::TYPE_UPDATE)
                //     ->setDoComponent('generator::plugin.create-file', function ($plugin) {
                //         return "{'plugin':'" . $plugin . "'}";
                //     }),
                GateConfig::Button('generator::plugin.action.create')
                    ->setIcon('<i class="bi bi-magic"></i>')
                    ->setClass('btn btn-sm btn-primary')
                    ->setPermission('core.plugin.generator')
                    ->setType(ButtonConfig::TYPE_ADD)
                    ->setDoComponent('generator::plugin.create')
            ];
            return $prev;
        });
        add_filter('filter_table_option_theme', function ($prev) {
            if (!isset($prev[ConfigManager::BUTTON_APPEND])) $prev[ConfigManager::BUTTON_APPEND] = [];
            $prev[ConfigManager::BUTTON_APPEND] = [
                ...$prev[ConfigManager::BUTTON_APPEND],
                // GateConfig::Button('generator::theme.action.createFile')
                //     ->setIcon('<i class="bi bi-magic"></i>')
                //     ->setClass('btn btn-sm btn-primary')
                //     ->setPermission('core.theme.generator.file')
                //     ->setType(ButtonConfig::TYPE_UPDATE)
                //     ->setDoComponent('generator::theme.create-file', function ($theme) {
                //         return "{'theme':'" . $theme . "'}";
                //     }),
                GateConfig::Button('generator::theme.action.create')
                    ->setIcon('<i class="bi bi-magic"></i>')
                    ->setClass('btn btn-sm btn-primary')
                    ->setPermission('core.theme.generator')
                    ->setType(ButtonConfig::TYPE_ADD)
                    ->setDoComponent('generator::theme.create')

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
        add_link_symbolic(__DIR__ . '/../public', public_path('modules/gate-generator'));
        add_asset_js(asset('modules/gate-generator/js/gate-generator.js'), '', 10);
        add_asset_css(asset('modules/gate-generator/css/gate-generator.css'), '', 10);

        $this->registerMenu();
        $this->extending();
    }
    private function bootGate()
    {
        if (!$this->app->runningInConsole()) {
            add_filter('core_auth_permission_custom', function ($prev) {
                return [
                    ...$prev,
                    "core.module.generator",
                    "core.module.generator.file",
                    "core.plugin.generator",
                    "core.plugin.generator.file",
                    "core.theme.generator",
                    "core.theme.generator.file"
                ];
            });
        }
    }
    public function packageBooted()
    {
        $this->bootGate();
    }
}
