<?php

namespace LaraIO\Generator\Traits;

use Illuminate\Config\Repository as Config;
use Illuminate\Console\Command as Console;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use LaraIO\Core\Facades\Core;

trait WithGenerator
{
    /**
     * The laravel config instance.
     *
     * @var Config
     */
    protected $config;

    /**
     * The laravel filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * The laravel console instance.
     *
     * @var Console
     */
    protected $console;

    /**
     * Get the laravel config instance.
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set the laravel config instance.
     *
     * @param Config $config
     *
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }


    /**
     * Get the laravel filesystem instance.
     *
     * @return Filesystem
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Set the laravel filesystem instance.
     *
     * @param Filesystem $filesystem
     *
     * @return $this
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * Get the laravel console instance.
     *
     * @return Console
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * Set the laravel console instance.
     *
     * @param Console $console
     *
     * @return $this
     */
    public function setConsole($console)
    {
        $this->console = $console;

        return $this;
    }
    public function bootWithGenerator(
        Config $config = null,
        Filesystem $filesystem = null,
        Console $console = null
    ) {
        $this->config = $config;
        $this->filesystem = $filesystem;
        $this->console = $console;
    }
    /**
     * The name will created.
     *
     * @var string
     */
    protected $name;


    /**
     * Force status.
     *
     * @var bool
     */
    protected $force = false;

    /**
     * set default type.
     *
     * @var string
     */
    protected $type = 'web';

    /**
     * set default base type.
     *
     * @var string
     */
    protected $baseType = 'module';
    /**
     * Enables the base.
     *
     * @var bool
     */
    protected $isActive = false;
    /**
     * Set type.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set active flag.
     *
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active)
    {
        $this->isActive = $active;

        return $this;
    }
    /**
     * Get the name of module will created. By default in studly case.
     *
     * @return string
     */
    public function getName()
    {
        return Str::studly($this->name);
    }
    public function getBaseType()
    {
        return $this->baseType;
    }
    protected $base;
    /**
     * Generate the module.
     */
    public function generate(): int
    {
        $name = $this->getName();
        $this->base = Core::By($this->getBaseType());
        return 0;
    }
}
