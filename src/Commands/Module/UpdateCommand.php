<?php

namespace GateGem\Generator\Commands\Module;

use GateGem\Core\Facades\Module;
use GateGem\Generator\Traits\WithGeneratorStub;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class UpdateCommand extends Command
{
    use WithGeneratorStub;

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
        $name = $this->getBaseName();

        if ($name) {
            $this->updateModule($name);

            return 0;
        }

        foreach (Module::getData() as $module) {
            $this->updateModule($module->getName());
        }

        return 0;
    }

    protected function updateModule($name)
    {
        $this->line('Running for module: <info>' . $name . '</info>');
        Module::update($name);

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
