<?php

namespace PhpGitHooks\Infrastructure\Composer;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use Composer\Script\Event;
use PhpGitHooks\Module\Configuration\Contract\Command\ConfigurationProcessor;
use PhpGitHooks\Module\Configuration\Contract\Command\ConfigurationProcessorHandler;

/**
 * Class ConfiguratorScript.
 *
 * @codingStandardsIgnoreFile
 */
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
            $app = new AppKernel('dev', true);
            $app->boot();
            $container = $app->getContainer();
            /**
             * @var ConfigurationProcessorHandler
             */
            $processor = $container->get('bruli.command.bus');

            $processor->handle(new ConfigurationProcessor($event->getIO()));
        }
    }
}
