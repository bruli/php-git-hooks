<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class AppKernel
{
    const SERVICES_FILE = 'services.xml';
    const CONFIG_PATH = '/config/';

    /**
     * @var ContainerBuilder
     */
    private $container;

    public function __construct()
    {
        $this->container = new ContainerBuilder();
        $this->getConfigServices();
    }

    private function getConfigServices()
    {
        $loader = new XmlFileLoader($this->container, new FileLocator(__DIR__.self::CONFIG_PATH));
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