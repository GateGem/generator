<?php

namespace LaraIO\Generator\Traits;

use Illuminate\Support\Str;
use LaraIO\Core\Facades\Module;

trait WithModuleCommand
{
    /**
     * Get the module name.
     *
     * @return string
     */
    public function getModuleName()
    {
        $module = $this->argument('module');
        return  Str::studly($module);
    }
    public function getModule(){
        return Module::find($this->getModuleName());
    }
}