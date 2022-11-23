<?php

namespace LaraIO\Generator\Commands\Theme;

use Illuminate\Console\Command;
use LaraIO\Generator\Support\BaseGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ThemeMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'theme:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $names = $this->argument('name');
        $success = true;

        foreach ($names as $name) {
            $code = with(new BaseGenerator($name, "theme"))
                ->setFilesystem($this->laravel['files'])
                ->setConfig($this->laravel['config'])
                ->setConsole($this)
                ->setType($this->getThemeType())
                ->setActive(!$this->option('disabled'))
                ->generate();

            if ($code === E_ERROR) {
                $success = false;
            }
        }

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
            ['name', InputArgument::IS_ARRAY, 'The names of themes will be created.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, 'Generate a plain theme (without some resources).'],
            ['api', null, InputOption::VALUE_NONE, 'Generate an api theme.'],
            ['web', null, InputOption::VALUE_NONE, 'Generate a web theme.'],
            ['disabled', 'd', InputOption::VALUE_NONE, 'Do not enable the theme at creation.'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the theme already exists.'],
        ];
    }

    /**
     * Get theme type .
     *
     * @return string
     */
    private function getThemeType()
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
