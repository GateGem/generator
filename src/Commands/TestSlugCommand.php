<?php

namespace LaraIO\Generator\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class TestSlugCommand extends Command
{
    protected $argumentName = 'slug';
    protected $name = '{slug}:test ';
      /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['slug', InputArgument::REQUIRED, 'The name of seeder will be created.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
    protected $description = 'Create a new test class.';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("xin choà");
    }
}
