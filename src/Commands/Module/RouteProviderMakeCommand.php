<?php

namespace LaraIO\Generator\Commands\Module;

use LaraIO\Generator\Support\Stub;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class RouteProviderMakeCommand extends GeneratorCommand
{
    protected $argumentName = 'module';

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'module:route-provider';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Create a new route service provider for the specified module.';

    /**
     * The command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when the file already exists.'],
        ];
    }

    /**
     * Get template contents.
     *
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->getModule();

        return (new Stub('/route-provider.stub', [
            'NAMESPACE'            => $this->getClassNamespace($module),
            'CLASS'                => $this->getFileName(),
            'LARAAPP_NAMESPACE'     => $module->getValue('namespace'),
            'MODULE'               => $this->getModuleName(),
            'CONTROLLER_NAMESPACE' => $this->getControllerNameSpace(),
            'WEB_ROUTES_PATH'      => $this->getWebRoutesPath(),
            'API_ROUTES_PATH'      => $this->getApiRoutesPath(),
            'LOWER_NAME'           => $module->getLowerName(),
        ]))->render();
    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return 'RouteServiceProvider';
    }

    /**
     * @return mixed
     */
    protected function getWebRoutesPath()
    {
        return  '/routes/web.php';
    }

    /**
     * @return mixed
     */
    protected function getApiRoutesPath()
    {
        return  '/routes/api.php';
    }

    /**
     * @return string
     */
    private function getControllerNameSpace(): string
    {
        $namespace = $this->getModule()->getValue('namespace');

        return str_replace('/', '\\', $namespace . 'Http/Controller');
    }
    protected function getConfigName()
    {
        return 'provider';
    }
}
