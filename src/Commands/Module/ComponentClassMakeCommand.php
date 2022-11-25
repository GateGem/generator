<?php

namespace LaraIO\Generator\Commands\Module;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command;
use LaraIO\Generator\Traits\WithGeneratorStub;

class ComponentClassMakeCommand extends Command
{
    use WithGeneratorStub;
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
    public function handle(): int
    {
        $this->bootWithGeneratorStub($this->laravel['files']);
        $this->GeneratorFileByStub('component-class');

        $this->writeComponentViewTemplate();

        return 0;
    }
    /**
     * Get replacement for $COMPONENT_NAME$.
     *
     * @return string
     */
    protected function getComponentNameReplacement()
    {
        return $this->getLowerClassReplacement();
    }
}
