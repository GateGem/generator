<?php

namespace GateGem\Generator\Commands\Module;

use GateGem\Core\Facades\Module;
use Illuminate\Console\Command;
use GateGem\Generator\Migrations\Migrator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrateStatusCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:migrate-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Status for all module migrations';

    /**
     * @var \GateGem\Generator\Contracts\RepositoryInterface
     */
    protected $module;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): int
    {
        $name = $this->argument('module');

        if ($name) {
            $module = Module::find($name);

            $this->migrateStatus($module);

            return 0;
        }

        foreach (Module::getData() as $module) {
            $this->line('Running for module: <info>' . $module->getName() . '</info>');
            $this->migrateStatus($module);
        }

        return 0;
    }

    /**
     * Run the migration from the specified module.
     *
     * @param $module
     */
    protected function migrateStatus($module)
    {
        $path = $module->getPath(config('generator.migration.path'));

        $this->call('migrate:status', [
            '--path' => $path,
            '--database' => $this->option('database'),
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
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
            ['direction', 'd', InputOption::VALUE_OPTIONAL, 'The direction of ordering.', 'asc'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to use.'],
        ];
    }
}
