<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use GateGem\Core\Facades\Module;
use Symfony\Component\Console\Input\InputArgument;

class ModuleDeleteCommand extends Command
{
    protected $name = 'module:delete';
    protected $description = 'Delete a module from the application';

    public function handle(): int
    {
        Module::delete($this->argument('module'));

        $this->info("Module {$this->argument('module')} has been deleted.");

        return 0;
    }

    protected function getArguments()
    {
        return [
            ['module', InputArgument::REQUIRED, 'The name of module to delete.'],
        ];
    }
}
