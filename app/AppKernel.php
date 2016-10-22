<?php

use Symfony\Component\HttpKernel\Kernel;

/**
 * Class AppKernel
 *
 * @@codingStandardsIgnoreFile
 */
class AppKernel extends Kernel
{
    const SERVICES_FILE = 'services.yml';
    const CONFIG_PATH = '/config/';

    public function registerBundles()
    {
        return [
            new \Bruli\EventBusBundle\EventBusBundle(),
        ];
    }

    /**
     * Loads the container configuration.
     *
     * @param \Symfony\Component\Config\Loader\LoaderInterface $loader A LoaderInterface instance
     */
    public function registerContainerConfiguration(\Symfony\Component\Config\Loader\LoaderInterface $loader)
    {
        $loader->load(__DIR__.self::CONFIG_PATH.self::SERVICES_FILE);
    }
}
