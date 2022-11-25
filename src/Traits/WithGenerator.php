<?php

namespace LaraIO\Generator\Traits;

use Illuminate\Config\Repository as Config;
use Illuminate\Console\Command as Console;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use LaraIO\Core\Facades\Core;
use LaraIO\Generator\Support\Config\GenerateConfigReader;
use LaraIO\Generator\Support\Stub;

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

    /**
     * Get the list of folders will created.
     *
     * @return array
     */
    public function getFolders()
    {
        return config('generator.paths.generator');
    }

    /**
     * Get the list of files will created.
     *
     * @return array
     */
    public function getFiles()
    {
        return [...config('generator.stubs.files.common'), ...config('generator.stubs.files.' . $this->getBaseType())];
    }

    /**
     * Set force status.
     *
     * @param bool|int $force
     *
     * @return $this
     */
    public function setForce($force)
    {
        $this->force = $force;

        return $this;
    }
    /**
     * Enables the base.
     *
     * @var \LaraIO\Core\Traits\WithLoadInfoJson
     */
    protected $base;
    /**
     * Generate the module.
     */
    public function generate(): int
    {
        $name = $this->getName();
        $this->base = Core::By($this->getBaseType());

        if ($this->base->has($name)) {
            if ($this->force) {
                $this->base->delete($name);
            } else {
                $this->console->error("{$this->getBaseType()} [{$name}] already exist!");

                return E_ERROR;
            }
        }

        $this->generateFolders();

        $this->generateInfoJsonFile();
        $this->base->RegisterApp();
        if ($this->type !== 'plain') {
            $this->generateFiles();
            $this->generateResources();
        }

        if ($this->type === 'plain') {
            $this->cleanModuleJsonFile();
        }


        $this->console->info("{$this->getBaseType()} [{$name}] created successfully.");

        return 0;
    }
    public function getPath($path)
    {
        return $this->base->getPath($this->getName()) . '/' . $path;
    }
    /**
     * Generate the folders.
     */
    public function generateFolders()
    {
        foreach ($this->getFolders() as $key => $folder) {
            $folder = GenerateConfigReader::read($key);

            if ($folder->generate($this->getBaseType()) === false) {
                continue;
            }

            $path = $this->getPath($folder->getPath());

            $this->filesystem->makeDirectory($path, 0755, true);
            if (config('modules.stubs.gitkeep')) {
                $this->generateGitKeep($path);
            }
        }
    }

    /**
     * Generate git keep to the specified path.
     *
     * @param string $path
     */
    public function generateGitKeep($path)
    {
        $this->filesystem->put($path . '/.gitkeep', '');
    }

    /**
     * Generate the files.
     */
    public function generateFiles()
    {
        foreach ($this->getFiles() as $stub => $file) {
            $path = $this->getPath($file);
            $path = $this->WriteFileWithReplacement($path, $stub);

            $this->console->info("Created : {$path}");
        }
    }

    /**
     * Generate some resources.
     */
    public function generateResources()
    {
        if (GenerateConfigReader::read('seeder')->generate($this->getBaseType()) === true) {
            $this->console->call('module:make-seed', [
                'name' => $this->getName(),
                'module' => $this->getName(),
                '--master' => true,
            ]);
        }

        if (GenerateConfigReader::read('provider')->generate($this->getBaseType()) === true) {
            $this->console->call('module:make-provider', [
                'name' => $this->getName() . 'ServiceProvider',
                'module' => $this->getName(),
                '--master' => true,
            ]);
            $this->console->call('module:route-provider', [
                'module' => $this->getName(),
            ]);
        }

        if (GenerateConfigReader::read('controller')->generate($this->getBaseType()) === true) {
            $options = $this->type == 'api' ? ['--api' => true] : [];
            $this->console->call('module:make-controller', [
                'controller' => $this->getName() . 'Controller',
                'module' => $this->getName(),
            ] + $options);
        }
    }

    /**
     * Get the contents of the specified stub file by given stub name.
     *
     * @param $stub
     *
     * @return string
     */
    protected function getStubContents($stub)
    {
        return (new Stub(
            '/' . $stub . '.stub',
            $this->getReplacement($stub)
        )
        )->render();
    }

    /**
     * get the list for the replacements.
     */
    public function getReplacements()
    {
        return  config('generator.stubs.replacements');
    }

    /**
     * Get array replacement for the specified stub.
     *
     * @param $stub
     *
     * @return array
     */
    protected function getReplacement($stub)
    {
        $replacements = config('generator.stubs.replacements');
        if ($stub == 'json-function') {
            $stub = 'json';
        }
        if (!isset($replacements[$stub])) {
            return [];
        }

        $keys = $replacements[$stub];

        $replaces = [];
        if (!in_array('BASE_TYPE', $keys)) {
            $keys[] = 'BASE_TYPE';
        }
        // if (!in_array('BASE_TYPE_LOWER_NAME', $keys)) {
        //     $keys[] = 'BASE_TYPE_LOWER_NAME';
        // }

        if ($stub === 'json' || $stub === 'composer' || $stub === 'provider-base') {
            if (in_array('PROVIDER_NAMESPACE', $keys, true) === false) {
                $keys[] = 'PROVIDER_NAMESPACE';
            }
        }
        foreach ($keys as $key) {
            if (method_exists($this, $method = 'get' . ucfirst(Str::studly(strtolower($key))) . 'Replacement')) {
                $replaces[$key] = $this->$method();
            } else {
                $replaces[$key] = null;
            }
        }

        return $replaces;
    }

    /**
     * Generate the BaseType.json file
     */
    private function generateInfoJsonFile()
    {
        $path = $this->getPath($this->getBaseType() . '.json');

        if (!$this->filesystem->isDirectory($dir = dirname($path))) {
            $this->filesystem->makeDirectory($dir, 0775, true);
        }
        if ($this->getBaseType() == 'module') {
            $this->filesystem->put($path, $this->getStubContents('json'));
        } else {
            $this->filesystem->put($path, $this->getStubContents('json-function'));
        }

        $this->console->info("Created : {$path}");
    }

    /**
     * Remove the default service provider that was added in the module.json file
     * This is needed when a --plain module was created
     */
    private function cleanInfoJsonFile()
    {
        $path = $this->getPath($this->getBaseType() . '.json');

        $content = $this->filesystem->get($path);
        $namespace = $this->getModuleNamespaceReplacement();
        $studlyName = $this->getStudlyNameReplacement();

        $provider = '"' . $namespace . '\\\\' . $studlyName . '\\\\Providers\\\\' . $studlyName . 'ServiceProvider"';

        $content = str_replace($provider, '', $content);

        $this->filesystem->put($path, $content);
    }
    public function WriteFileWithReplacement($path, $stub)
    {
        $replacements = $this->getReplacement($stub);
        foreach ($replacements as $search => $replace) {
            $path = str_replace('$' . strtoupper($search) . '$', $replace, $path);
        }
        if (!$this->filesystem->isDirectory($dir = dirname($path))) {
            $this->filesystem->makeDirectory($dir, 0775, true);
        }
        $this->filesystem->put($path, (new Stub(
            '/' . $stub . '.stub',
            $replacements
        )
        )->render());
        return $path;
    }
    /**
     * Get the module name in lower case.
     *
     * @return string
     */
    protected function getLowerNameReplacement()
    {
        return strtolower($this->getName());
    }
    /**
     * Get the module name in studly case.
     *
     * @return string
     */
    protected function getBaseTypeNameReplacement()
    {
        return strtolower($this->baseType);
    }
    private $BaseTypeReplacement;
    /**
     * Get the module name in studly case.
     *
     * @return string
     */
    protected function getBaseTypeReplacement()
    {
        return $this->BaseTypeReplacement ?? ($this->BaseTypeReplacement = config('generator.namespace.' . $this->baseType, config('core.appdir.' . $this->baseType)));
    }
    /**
     * Get the module name in studly case.
     *
     * @return string
     */
    protected function getStudlyNameReplacement()
    {
        return $this->getName();
    }

    /**
     * Get replacement for $VENDOR$.
     *
     * @return string
     */
    protected function getVendorReplacement()
    {
        return config('generator.composer.vendor');
    }

    /**
     * Get replacement for $LARAAPP_NAMESPACE$\$BASE_TYPE$.
     *
     * @return string
     */
    protected function getModuleNamespaceReplacement()
    {
        return str_replace('\\', '\\\\', config('generator.namespace'));
    }

    /**
     * Get replacement for $AUTHOR_NAME$.
     *
     * @return string
     */
    protected function getAuthorNameReplacement()
    {
        return config('generator.composer.author.name');
    }

    /**
     * Get replacement for $AUTHOR_EMAIL$.
     *
     * @return string
     */
    protected function getAuthorEmailReplacement()
    {
        return config('generator.composer.author.email');
    }
    private $LaraappNamespaceReplacement;
    protected function getLaraappNamespaceReplacement(): string
    {
        return $this->LaraappNamespaceReplacement ?? ($this->LaraappNamespaceReplacement = config('generator.namespace.root', config('core.appdir.root')));
    }
    protected function getProviderNamespaceReplacement(): string
    {
        return str_replace('\\', '\\\\', GenerateConfigReader::read('provider')->getNamespace());
    }
}
