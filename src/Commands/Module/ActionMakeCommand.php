<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Console\Command;
use LaraIO\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;

class ActionMakeCommand extends Command
{
    use WithGeneratorStub;

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
    protected $name = 'module:make-action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event class for the specified module';

    public function handle(): int
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub('action');
        return 0;
    }

}
