<?php

namespace GateGem\Generator\Commands\Module;

use GateGem\Core\Facades\Module;
use Illuminate\Console\Command;

class UnUseCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:unuse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forget the used module with module:use';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Module::forgetUsed();

        $this->info('Previous module used successfully forgotten.');

        return 0;
    }
}
