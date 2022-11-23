<?php

namespace LaraIO\Generator\Commands\Module;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use LaraIO\Generator\Exceptions\FileAlreadyExistException;
use LaraIO\Generator\Support\Config\GenerateConfigReader;
use LaraIO\Generator\Support\FileGenerator;
use LaraIO\Generator\Traits\WithModuleCommand;

abstract class GeneratorCommand extends Command
{
    use WithModuleCommand;
    /**
     * The name of 'name' argument.
     *
     * @var string
     */
    protected $argumentName = '';
    abstract protected function getConfigName();
    /**
     * Get template contents.
     *
     * @return string
     */
    abstract protected function getTemplateContents();

    /**
     * Get the destination file path.
     *
     * @return string
     */
    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $commandPath = GenerateConfigReader::read('command');
        return $this->getModule()->getPath( $commandPath->getPath() . '/' . $this->getFileName() . '.php');
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $path = str_replace('\\', '/', $this->getDestinationFilePath());

        if (!$this->laravel['files']->isDirectory($dir = dirname($path))) {
            $this->laravel['files']->makeDirectory($dir, 0777, true);
        }

        $contents = $this->getTemplateContents();

        try {
            $overwriteFile = $this->hasOption('force') ? $this->option('force') : false;
            (new FileGenerator($path, $contents))->withFileOverwrite($overwriteFile)->generate();

            $this->info("Created : {$path}");
        } catch (FileAlreadyExistException $e) {
            $this->error("File : {$path} already exists.");

            return E_ERROR;
        }

        return 0;
    }

    /**
     * Get class name.
     *
     * @return string
     */
    public function getClass()
    {
        return class_basename($this->argument($this->argumentName));
    }
    /**
     * Get default namespace.
     *
     * @return string
     */
    public function getDefaultNamespace(): string
    {
        $commandPath = GenerateConfigReader::read($this->getConfigName());
        return $this->getModule()->getValue('namespace') . '/' . $commandPath->getPath();
    }
    /**
     * Get class namespace.
     *
     * @param \LaraIO\Generator\Module $module
     *
     * @return string
     */
    public function getClassNamespace($module)
    {
        $extra = str_replace($this->getClass(), '', $this->argument($this->argumentName));

        $extra = str_replace('/', '\\', $extra);

        $namespace = "";

        $namespace .= '\\' . $module->getStudlyName();

        $namespace .= '\\' . $this->getDefaultNamespace();

        $namespace .= '\\' . $extra;

        $namespace = str_replace('/', '\\', $namespace);

        return trim($namespace, '\\');
    }
    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name'));
    }
}
