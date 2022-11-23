<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Support\Str;
use LaraIO\Generator\Support\Config\GenerateConfigReader;
use LaraIO\Generator\Support\Stub;
use LaraIO\Generator\Traits\WithModuleCommand;
use Symfony\Component\Console\Input\InputArgument;

class PolicyMakeCommand extends GeneratorCommand
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
    protected $name = 'module:make-policy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new policy class for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the policy class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        return (new Stub('/policy.plain.stub', [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }

    protected function getConfigName()
    {
        return 'policies';
    }
}
