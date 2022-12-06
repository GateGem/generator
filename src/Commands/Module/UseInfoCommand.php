<?php

namespace GateGem\Generator\Commands\Module;

use GateGem\Core\Facades\Module;
use Illuminate\Console\Command;

class UseInfoCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:use-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use the specified module.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $module = Module::getUsed();

        if (!$module) {
            $this->error("Module does not used.");

            return E_ERROR;
        }
        $this->info("Module used is [{$module}].");

        return 0;
    }
}
