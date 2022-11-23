<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Support\Str;
use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;

class ComponentClassMakeCommand extends GeneratorCommand
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
    protected $name = 'module:make-component';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new component-class for the specified module.';

    public function handle(): int
    {
        if (parent::handle() === E_ERROR) {
            return E_ERROR;
        }
        $this->writeComponentViewTemplate();

        return 0;
    }
     /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the component.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * Write the view template for the component.
     *
     * @return void
     */
    protected function writeComponentViewTemplate()
    {
        $this->call('module:make-component-view', ['name' => $this->argument('name'), 'module' => $this->argument('module')]);
    }
    protected function getConfigName()
    {
        return 'component-class';
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        return (new Stub('/component-class.stub', [
            'NAMESPACE'         => $this->getClassNamespace($this->getModule()),
            'CLASS'             => $this->getClass(),
            'LOWER_NAME'        => Str::lower($this->getModuleName()),
            'COMPONENT_NAME'    => 'components.' . Str::lower($this->argument('name')),
        ]))->render();
    }
}
