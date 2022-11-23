<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Console\Command;
use LaraIO\Generator\Traits\WithModuleCommand;
use Symfony\Component\Console\Input\InputArgument;

class UpdateCommand extends Command
{
    use WithModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update dependencies for the specified module or for all modules.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $name = $this->argument('module');

        if ($name) {
            $this->updateModule($name);

            return 0;
        }

        /** @var \LaraIO\Generator\Module $module */
        foreach ($this->laravel['modules']->getOrdered() as $module) {
            $this->updateModule($module->getName());
        }

        return 0;
    }

    protected function updateModule($name)
    {
        $this->line('Running for module: <info>' . $name . '</info>');

        $this->laravel['modules']->update($name);

        $this->info("Module [{$name}] updated successfully.");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be updated.'],
        ];
    }
}