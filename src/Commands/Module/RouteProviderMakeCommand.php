<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RouteProviderMakeCommand extends Command
{
    use WithGeneratorStub;
    protected $argumentName = 'module';

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'module:route-provider';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Create a new route service provider for the specified module.';

    /**
     * The command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the file already exists.'],
        ];
    }
    public function getFileName()
    {
        return 'Route';
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub('route-provider');
        return 0;
    }
}
