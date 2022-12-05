<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;

class ControllerMakeCommand extends Command
{
    use WithGeneratorStub;
    /**
     * The name of argument being used.
     *
     * @var string
     */
    protected $argumentName = 'controller';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new restful controller for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the controller class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['plain', 'p', InputOption::VALUE_NONE, 'Generate a plain controller', null],
            ['api', null, InputOption::VALUE_NONE, 'Exclude the create and edit methods from the controller.'],
        ];
    }

    public function handle(): int
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub($this->getStubName());
        return 0;
    }
    /**
     * Get the stub file name based on the options
     * @return string
     */
    protected function getStubName()
    {
        if ($this->option('plain') === true) {
            $stub = 'controller-plain';
        } elseif ($this->option('api') === true) {
            $stub = 'controller-api';
        } else {
            $stub = 'controller';
        }

        return $stub;
    }
}
