<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Console\Command;
use LaraIO\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;

class RuleMakeCommand extends Command
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
    protected $name = 'module:make-rule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new validation rule for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the rule class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }
/**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->bootWithGeneratorStub($this->laravel['files']);
        $this->GeneratorFileByStub('rule');
        return 0;
    }
}
