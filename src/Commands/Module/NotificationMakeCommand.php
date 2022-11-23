<?php

namespace LaraIO\Generator\Commands\Module;

use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;

final class NotificationMakeCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-notification';

    protected $argumentName = 'name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new notification class for the specified module.';

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {
        return (new Stub('/notification.stub', [
            'NAMESPACE' => $this->getClassNamespace($this->getModule()),
            'CLASS'     => $this->getClass(),
        ]))->render();
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the notification class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
    protected function getConfigName()
    {
        return 'notifications';
    }
}
