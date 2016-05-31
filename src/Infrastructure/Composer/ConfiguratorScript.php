<?php

namespace Infrastructure\Composer;

require_once __DIR__ . '/../../../app/AppKernel.php';
use AppKernel;
use Composer\Script\Event;
use Module\Configuration\Service\ConfigurationProcessor;

class ConfiguratorScript
{
    /**
     * @param Event $event
     *
     * @return mixed
     */
    public static function buildConfig(Event $event)
    {
        if (true === $event->isDevMode()) {
            $container = new AppKernel();
            /** @var ConfigurationProcessor $processor */
            $processor = $container->get('configurator.processor');

            $processor->process($event->getIO());
        }
    }
}
