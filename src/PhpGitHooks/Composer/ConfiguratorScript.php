<?php

namespace PhpGitHooks\Composer;

use Composer\Script\Event;
use PhpGitHooks\Container;
use PhpGitHooks\Infraestructure\Config\CheckConfigFile;

/**
 * Class ConfiguratorScript
 * @package PhpGitHooks\Composer
 */
class ConfiguratorScript
{
    /**
     * @param Event $event
     */
    public static function buildConfig(Event $event)
    {
        if (false === $event->isDevMode()) {
            return;
        }

        $container = new Container();

        /** @var ConfiguratorProcessor $processor */
        $processor = $container->get('configurator.processor');
        $processor->setIO($event->getIO());

        return $processor->process();

//        $processor = new ConfiguratorProcessor($event->getIO(), new CheckConfigFile());
//
//        return $processor->process();
    }
}
