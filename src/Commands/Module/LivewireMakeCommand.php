<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use GateGem\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class LivewireMakeCommand extends Command
{
    use WithGeneratorStub;

    // {component} {module} {--view=} {--force} {--inline} {--stub=} {--custom}
    protected $name = 'module:make-livewire';
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the command.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['view', null, InputOption::VALUE_OPTIONAL, 'The event class being listened for.'],
            ['inline', null, InputOption::VALUE_OPTIONAL, 'Indicates the event listener should be queued.',true],
        ];
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Livewire Component.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub($this->getStubName());
        return 0;
    }
    /**
     * @return string
     */
    protected function getStubName(): string
    {
        if ($this->option('inline')) {

            return 'livewire-inline';
        }
        return 'livewire';
    }
    protected function getViewNameReplacement()
    {
        if ($this->option('view')) {
            return Str::lower($this->option('view'));
        }
        return 'index';
    }
}
