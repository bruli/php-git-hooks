<?php


namespace PhpGitHooks;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class Container
 * @package PhpGitHooks
 */
class Container
{
    const SERVICES_YML = 'services.yml';
    const CONFIG_PATH = '/../../config/';

    /** @var ContainerBuilder */
    private $container;

    public function __construct()
    {
        $this->container = new ContainerBuilder();
        $this->getConfigServices();
    }

    private function getConfigServices()
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__.self::CONFIG_PATH));
        $loader->load(self::SERVICES_YML);
    }

    /**
     * @param  string $serviceName
     * @return object
     */
    public function get($serviceName)
    {
        return $this->container->get($serviceName);
    }
}
