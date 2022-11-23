<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Str;
use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;

class ComponentViewMakeCommand extends GeneratorCommand
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
    protected $name = 'module:make-component-view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new component-view for the specified module.';

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
     * @return mixed
     */
    protected function getTemplateContents()
    {
        return (new Stub('/component-view.stub', ['QUOTE' => Inspiring::quote()]))->render();
    }
    protected function getConfigName()
    {
        return 'component-view';
    }
    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::lower($this->argument('name')) . '.blade.php';
    }
}
