<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use LaraIO\Generator\Traits\WithGeneratorStub;

class CommandMakeCommand extends Command
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
    protected $name = 'module:make-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new Artisan command for the specified module.';

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
    protected function getConfigName()
    {
        return 'command';
    }
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['command', null, InputOption::VALUE_OPTIONAL, 'The terminal command that should be assigned.', null],
        ];
    }
   
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->bootWithGeneratorStub();

        $this->GeneratorFileByStub('command');
        $this->info('done');

        return 0;
    }
    /**
     * Get replacement for $COMMAND_NAME$.
     *
     * @return string
     */
    protected function getCommandNameReplacement()
    {
        return $this->option('command') ?: 'command:name';
    }
}
