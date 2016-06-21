<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AppKernel
{
    const SERVICES_FILE = 'services.yml';
    const CONFIG_PATH = '/config/';

    /**
     * @var ContainerBuilder
     */
    private $container;

    public function __construct()
    {
        $this->container = new ContainerBuilder();
        $this->container->addCompilerPass(new \CommandBus\CommandBus\CommandBusCompilerPass());
        $this->container->addCompilerPass(new \CommandBus\QueryBus\QueryBusCompilerPass());
        $this->getConfigServices();
        $this->container->compile();
    }

    private function getConfigServices()
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__.self::CONFIG_PATH));
        $loader->load(self::SERVICES_FILE);
    }

    /**
     * @param string $serviceName
     *
     * @return object
     */
    public function get($serviceName)
    {
        return $this->container->get($serviceName);
    }
}
