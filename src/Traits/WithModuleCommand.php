<?php

namespace LaraIO\Generator\Traits;

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

        $module = app('modules')->findOrFail($module);

        return $module->getStudlyName();
    }
}
