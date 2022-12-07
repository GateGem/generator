<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class TableMakeCommand extends Command
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
    protected $name = 'module:make-table';
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['migration', 'm', InputOption::VALUE_NONE, 'Flag to create associated migrations', null],
            ['model', 'o', InputOption::VALUE_NONE, 'Flag to create associated controllers', null],
        ];
    }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event class for the specified module';

    public function handle(): int
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub('table');
        $this->handleOptionalMigrationOption();
        $this->handleOptionalModelOption();
        return 0;
    }
    /**
     * Get replacement for $NAMESPACE_MODEL$.
     *
     * @return string
     */
    public function getNamespaceModelReplacement()
    {
        return $this->getNamespaceByPath('model');
    }

    /**
     * Create a proper migration name:
     * ProductDetail: product_details
     * Product: products
     * @return string
     */
    private function createMigrationName()
    {
        $pieces = preg_split('/(?=[A-Z])/', $this->argument('name'), -1, PREG_SPLIT_NO_EMPTY);

        $string = '';
        foreach ($pieces as $i => $piece) {
            if ($i + 1 < count($pieces)) {
                $string .= strtolower($piece) . '_';
            } else {
                $string .= Str::plural(strtolower($piece));
            }
        }

        return $string;
    }
    /**
     * Create the migration file with the given table if migration flag was used
     */
    private function handleOptionalMigrationOption()
    {
        if ($this->option('migration') === true) {
            $migrationName = 'create_' . $this->createMigrationName() . '_table';
            $this->call('module:make-migration', ['name' => $migrationName, 'module' => $this->getBaseName()]);
        }
    }
    /**
     * Create the model file with the given table if model flag was used
     */
    private function handleOptionalModelOption()
    {
        if ($this->option('model') === true) {
            $this->call('module:make-model', ['name' => $this->getFileName(), 'module' => $this->getBaseName()]);
        }
    }
}
