<?php

namespace LaraIO\Generator\Commands\Module;

use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;

class EventMakeCommand extends GeneratorCommand
{

    protected $argumentName = 'name';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the event.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event class for the specified module';

    public function getTemplateContents()
    {

        return (new Stub('/event.stub', [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'CLASS' => $this->getClass(),
        ]))->render();
    }
    protected function getConfigName()
    {
        return 'event';
    }

}
