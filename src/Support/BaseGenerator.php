<?php

namespace LaraIO\Generator\Support;

use Illuminate\Config\Repository as Config;
use Illuminate\Console\Command as Console;
use Illuminate\Filesystem\Filesystem;
use LaraIO\Generator\Traits\WithGenerator;

class BaseGenerator extends Generator
{
    use WithGenerator;

    /**
     * The constructor.
     * @param $name
     * @param Config     $config
     * @param Filesystem $filesystem
     * @param Console    $console
     */
    public function __construct(
        $name,
        $baseType,
        Config $config = null,
        Filesystem $filesystem = null,
        Console $console = null
    ) {
        $this->name = $name;
        $this->baseType = $baseType;
        $this->bootWithGenerator($config, $filesystem, $console);
    }
}
