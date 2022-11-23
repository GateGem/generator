<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Support\Str;
use LaraIO\Generator\Support\Config\GenerateConfigReader;
use LaraIO\Generator\Support\Stub;
use LaraIO\Generator\Traits\WithModuleCommand;
use Symfony\Component\Console\Input\InputArgument;

class MiddlewareMakeCommand extends GeneratorCommand
{
    use WithModuleCommand;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-middleware';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new middleware class for the specified module.';
   
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the command.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {

        return (new Stub('/middleware.stub', [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }

    protected function getConfigName()
    {
        return 'filter';
    }
}
