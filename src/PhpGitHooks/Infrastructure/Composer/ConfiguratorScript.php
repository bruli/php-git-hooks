<?php

namespace PhpGitHooks\Infrastructure\Composer;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use Composer\Script\Event;
use PhpGitHooks\Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use PhpGitHooks\Module\Configuration\Contract\CommandHandler\ConfigurationProcessorCommandHandler;

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
             * @var ConfigurationProcessorCommandHandler
             */
            $processor = $container->get('bruli.command.bus');

            $processor->handle(new ConfigurationProcessorCommand($event->getIO()));
        }
    }
}
