<?php

namespace LaraIO\Generator\Commands;

use Illuminate\Console\Command;
use LaraIO\Core\Facades\Plugin;
use Symfony\Component\Console\Input\InputArgument;

class PluginDeleteCommand extends Command
{
    protected $name = 'plugin:delete';
    protected $description = 'Delete a plugin from the application';

    public function handle(): int
    {
        Plugin::delete($this->argument('plugin'));

        $this->info("Plugin {$this->argument('plugin')} has been deleted.");

        return 0;
    }

    protected function getArguments()
    {
        return [
            ['plugin', InputArgument::REQUIRED, 'The name of plugin to delete.'],
        ];
    }
}
