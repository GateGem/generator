<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Support\Str;
use LaraIO\Generator\Support\Config\GenerateConfigReader;
use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class TestMakeCommand extends GeneratorCommand
{

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
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $stub = '/unit-test.stub';

        if ($this->option('feature')) {
            $stub = '/feature-test.stub';
        }

        return (new Stub($stub, [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }

    protected function getConfigName()
    {
        if ($this->option('feature'))
            return 'test-feature';
        return 'test';
    }
}
