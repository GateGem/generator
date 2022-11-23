<?php

namespace LaraIO\Generator\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use LaraIO\Core\Facades\Module;

trait CommandHelper
{
    protected function isCustomModule()
    {
        return $this->option('custom') === true;
    }

    protected function isForce()
    {
        return $this->option('force') === true;
    }

    protected function isInline()
    {
        return $this->option('inline') === true;
    }

    protected function ensureDirectoryExists($path)
    {
        if (!File::isDirectory(dirname($path))) {
            File::makeDirectory(dirname($path), 0777, $recursive = true, $force = true);
        }
    }

    protected function getModule()
    {
        $moduleName = $this->argument('module');

        if ($this->isCustomModule()) {
            $module = config("generator.livewire.custom_modules.{$moduleName}");

            $path = $module['path'] ?? '';

            if (!$module || !File::isDirectory($path)) {
                $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");

                $path && $this->line("<fg=red;options=bold>The custom {$moduleName} module not found in this path - {$path}.</>");

                !$path && $this->line("<fg=red;options=bold>The custom {$moduleName} module not found.</>");

                return null;
            }

            return $moduleName;
        }

        if (!$module = Module::find($moduleName)) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>The {$moduleName} module not found.</>");

            return null;
        }

        return $module;
    }

    protected function getModuleName()
    {
        return $this->isCustomModule()
            ? $this->module
            : $this->module->getName();
    }

    protected function getModuleLowerName()
    {
        return $this->isCustomModule()
            ? config("generator.livewire.custom_modules.{$this->module}.name_lower", strtolower($this->module))
            : $this->module->getLowerName();
    }

    protected function getModulePath()
    {
        $path = $this->isCustomModule()
            ? config("generator.livewire.custom_modules.{$this->module}.path")
            : $this->module->getPath();

        return strtr($path, ['\\' => '/']);
    }

    protected function getModuleNamespace()
    {
        return $this->isCustomModule()
            ? config("generator.livewire.custom_modules.{$this->module}.LARAAPP_NAMESPACE", $this->module)
            : config('modules.namespace', 'Modules');
    }

    protected function getModuleLivewireNamespace()
    {
        $moduleLivewireNamespace = config('generator.livewire.namespace', 'Http\\Livewire');

        if ($this->isCustomModule()) {
            return config("generator.livewire.custom_modules.{$this->module}.namespace", $moduleLivewireNamespace);
        }

        return $moduleLivewireNamespace;
    }

    protected function getNamespace($classPath)
    {
        $classPath = Str::contains($classPath, '/') ? '/' . $classPath : '';

        $prefix = $this->isCustomModule()
            ? $this->getModuleNamespace() . '\\' . $this->getModuleLivewireNamespace()
            : $this->getModuleNamespace() . '\\' . $this->module->getName() . '\\' . $this->getModuleLivewireNamespace();

        return (string) Str::of($classPath)
            ->beforeLast('/')
            ->prepend($prefix)
            ->replace(['/'], ['\\']);
    }

    protected function getModuleLivewireViewDir()
    {
        $moduleLivewireViewDir = config('generator.livewire.view', 'Resources/views/livewire');

        if ($this->isCustomModule()) {
            $moduleLivewireViewDir = config("generator.livewire.custom_modules.{$this->module}.view", $moduleLivewireViewDir);
        }

        return $this->getModulePath() . '/' . $moduleLivewireViewDir;
    }

    protected function checkClassNameValid()
    {
        if (!$this->isClassNameValid($name = $this->component->class->name)) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is invalid:</> {$name}");

            return false;
        }

        return true;
    }

    protected function checkReservedClassName()
    {
        if ($this->isReservedClassName($name = $this->component->class->name)) {
            $this->line("<options=bold,reverse;fg=red> WHOOPS! </> 😳 \n");
            $this->line("<fg=red;options=bold>Class is reserved:</> {$name}");

            return false;
        }

        return true;
    }

    protected function isClassNameValid($name)
    {
        return (new \Livewire\Commands\MakeCommand())->isClassNameValid($name);
    }

    protected function isReservedClassName($name)
    {
        return (new \Livewire\Commands\MakeCommand())->isReservedClassName($name);
    }
}
