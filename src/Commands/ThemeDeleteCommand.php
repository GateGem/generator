<?php

namespace LaraIO\Generator\Commands;

use Illuminate\Console\Command;
use LaraIO\Core\Facades\Theme;
use Symfony\Component\Console\Input\InputArgument;

class ThemeDeleteCommand extends Command
{
    protected $name = 'theme:delete';
    protected $description = 'Delete a theme from the application';

    public function handle(): int
    {
        Theme::delete($this->argument('theme'));

        $this->info("Theme {$this->argument('theme')} has been deleted.");

        return 0;
    }

    protected function getArguments()
    {
        return [
            ['theme', InputArgument::REQUIRED, 'The name of theme to delete.'],
        ];
    }
}
