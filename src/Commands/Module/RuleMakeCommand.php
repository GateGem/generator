<?php

namespace LaraIO\Generator\Commands\Module;

use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;

class RuleMakeCommand extends GeneratorCommand
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
    protected $name = 'module:make-rule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new validation rule for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the rule class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {

        return (new Stub('/rule.stub', [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'CLASS'     => $this->getFileName(),
        ]))->render();
    }

    protected function getConfigName()
    {
        return 'rules';
    }
}
