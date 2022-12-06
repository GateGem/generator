<?php

namespace GateGem\Generator\Commands\Module;

use Illuminate\Console\Command;
use GateGem\Generator\Traits\WithGeneratorStub;
use GateGem\Generator\Support\Migrations\NameParser;
use GateGem\Generator\Support\Migrations\SchemaParser;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrationMakeCommand extends Command
{
    use WithGeneratorStub;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The migration name will be created.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be created.'],
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
            ['fields', null, InputOption::VALUE_OPTIONAL, 'The specified fields table.', null],
            ['plain', null, InputOption::VALUE_NONE, 'Create plain migration.'],
        ];
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->option('fields'));
    }
    /**
     * Run the command.
     */
    public function handle(): int
    {
        $this->bootWithGeneratorStub();
        $this->GeneratorFileByStub($this->getStubName());
        return 0;
    }
    public $table_name;
    public function getStubName()
    {
        $parser = new NameParser($this->argument('name'));
        $this->table_name = $parser->getTableName();
        if ($parser->isCreate()) {
            return 'migration/create';
        } elseif ($parser->isAdd()) {
            return 'migration/add';
        } elseif ($parser->isDelete()) {
            return 'migration/delete';
        } elseif ($parser->isDrop()) {
            return 'migration/drop';
        }
        return 'migration/plain';
    }
    /**
     * Get replacement for $FILE_MIGRATION$.
     *
     * @return string
     */
    protected function getFileMigrationReplacement()
    {
        return date('Y_m_d_His_') . $this->getFileName();
    }
    /**
     * Get replacement for $TABLE$.
     *
     * @return string
     */
    protected function getTableReplacement()
    {
        return  $this->table_name;
    }
    /**
     * Get replacement for $FIELDS$.
     *
     * @return string
     */
    protected function getFieldsReplacement()
    {
        return $this->getSchemaParser()->render();
    }
    /**
     * Get replacement for $FIELDS_UP$.
     *
     * @return string
     */
    protected function getFieldsUpReplacement()
    {
        return $this->getSchemaParser()->up();
    }
    /**
     * Get replacement for $FIELDS_DOWN$.
     *
     * @return string
     */
    protected function getFieldsDownReplacement()
    {
        return $this->getSchemaParser()->down();
    }
}
