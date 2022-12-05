<?php

namespace GateGem\Generator\Commands\Module;

use GateGem\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;

class MailMakeCommand extends Command
{
    use WithGeneratorStub;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new email class for the specified module';

    protected $argumentName = 'name';
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the mailable.'],
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
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub('mail');
        return 0;
    }
}
