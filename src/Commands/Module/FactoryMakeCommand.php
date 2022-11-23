<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Support\Str;
use LaraIO\Generator\Support\Config\GenerateConfigReader;
use LaraIO\Generator\Support\Stub;
use LaraIO\Generator\Traits\WithModuleCommand;
use Symfony\Component\Console\Input\InputArgument;

class FactoryMakeCommand extends GeneratorCommand
{

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
    protected $name = 'module:make-factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {

        return (new Stub('/factory.stub', [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'NAME' => $this->getModelName(),
            'MODEL_NAMESPACE' => $this->getModelNamespace(),
        ]))->render();
    }

    /**
     * Get model namespace.
     *
     * @return string
     */
    public function getModelNamespace(): string
    {
        return "";
    }
    protected function getConfigName()
    {
        return 'factory';
    }
}
