<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use LaraIO\Generator\Traits\WithGeneratorStub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ResourceMakeCommand  extends Command
{
    use WithGeneratorStub;
    protected $argumentName = 'name';
    protected $name = 'module:make-resource';
    protected $description = 'Create a new resource class for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the resource class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a resource collection.'],
        ];
    }

    /**
     * Determine if the command is generating a resource collection.
     *
     * @return bool
     */
    protected function collection(): bool
    {
        return $this->option('collection') ||
            Str::endsWith($this->argument('name'), 'Collection');
    }
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
        if ($this->collection()) {
            return 'resource-collection';
        }

        return 'resource';
    }
}
