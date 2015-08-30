<?php

namespace PhpGitHooks\Application\Composer;

use Composer\Script\Event;
use PhpGitHooks\Container;
use PhpGitHooks\Infrastructure\Composer\ConfiguratorProcessor;

final class ConfiguratorScript
{
    public static function buildConfig(Event $event)
    {
        if (true === $event->isDevMode()) {
            $container = new Container();
            /** @var ConfiguratorProcessor $processor */
            $processor = $container->get('configurator.processor');
            $processor->setIO($event->getIO());

            return $processor->process();
        }
    }
}
