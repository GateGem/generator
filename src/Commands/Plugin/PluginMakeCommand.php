<?php

namespace GateGem\Generator\Commands\Plugin;

use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class PluginMakeCommand extends Command
{
    use WithGeneratorStub;
    public function getBaseTypeName()
    {
        return 'plugin';
    }
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new plugin.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $names = $this->argument('name');
        $success = true;
        $this->bootWithGeneratorStub();

        $names = $this->argument('name');
        $success = true;

        foreach ($names as $name) {
            $code = $this->generate($name);

            if ($code === E_ERROR) {
                $success = false;
            }
        }
        $this->info('done');

        return $success ? 0 : E_ERROR;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::IS_ARRAY, 'The names of plugins will be created.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, 'Generate a plain plugin (without some resources).'],
            ['api', null, InputOption::VALUE_NONE, 'Generate an api plugin.'],
            ['web', null, InputOption::VALUE_NONE, 'Generate a web plugin.'],
            ['disabled', 'd', InputOption::VALUE_NONE, 'Do not enable the plugin at creation.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the plugin already exists.'],
        ];
    }

    /**
     * Get plugin type .
     *
     * @return string
     */
    private function getPluginType()
    {
        $isPlain = $this->option('plain');
        $isApi = $this->option('api');

        if ($isPlain && $isApi) {
            return 'web';
        }
        if ($isPlain) {
            return 'plain';
        } elseif ($isApi) {
            return 'api';
        } else {
            return 'web';
        }
    }
}
