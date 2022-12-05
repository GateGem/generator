<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SeedMakeCommand extends Command
{
    use WithGeneratorStub;

    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new seeder for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of seeder will be created.'],
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
            [
                'master',
                null,
                InputOption::VALUE_NONE,
                'Indicates the seeder will created is a master database seeder.',
            ],
        ];
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub('seeder');
        return 0;
    }
}
