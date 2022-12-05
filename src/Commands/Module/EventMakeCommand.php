<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;

class EventMakeCommand extends Command
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
    protected $name = 'module:make-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event class for the specified module';

    public function handle(): int
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub('event');
        return 0;
    }

}
