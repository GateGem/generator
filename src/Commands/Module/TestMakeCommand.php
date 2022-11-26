<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Console\Command;
use LaraIO\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class TestMakeCommand extends Command
{
    use WithGeneratorStub;

    protected $argumentName = 'name';
    protected $name = 'module:make-test';
    protected $description = 'Create a new test class for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the form request class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['feature', false, InputOption::VALUE_NONE, 'Create a feature test.'],
        ];
    }
 /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $stub = 'unit-test';

        if ($this->option('feature')) {
            $stub = 'feature-test';
        }
        $this->bootWithGeneratorStub($this->laravel['files']);
        $this->GeneratorFileByStub($stub);
        return 0;
    }
}
