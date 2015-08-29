<?php

namespace PhpGitHooks\Application\Composer;

use Composer\Script\Event;
use PhpGitHooks\Container;

final class ConfiguratorScript
{
    public static function buildConfig(Event $event)
    {
        if (true === $event->isDevMode()) {
            $container = new Container();
            /**
             * @var ConfiguratorProcessor
             */
            $processor = $container->get('configurator.processor');
            $processor->setIO($event->getIO());

            return $processor->process();
        }
    }
}
