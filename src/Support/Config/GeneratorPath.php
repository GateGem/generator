<?php

namespace LaraIO\Generator\Support\Config;

class GeneratorPath
{
    private $path;
    private $generate;
    private $namespace;
    private $only;

    public function __construct($config)
    {
        if (is_array($config)) {
            $this->path = $config['path'];
            $this->generate = $config['generate'];
            $this->only = isset($config['only']) && is_array($config['only']) ? $config['only'] : [];
            $this->namespace = $config['namespace'] ?? $this->convertPathToNamespace($config['path']);

            return;
        }
        $this->path = $config;
        $this->generate = (bool) $config;
        $this->only = [];
        $this->namespace = $config;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function generate($base_type = ''): bool
    {
        if ($base_type != '' &&  count($this->only) > 0) {
            if (!in_array($base_type, $this->only))
                return false;
        }
        return $this->generate;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    private function convertPathToNamespace($path)
    {
        return str_replace('/', '\\', $path);
    }
}
