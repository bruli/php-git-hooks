<?php

namespace PhpGitHooks\Infrastructure\Composer;

require_once __DIR__.'/../../../../app/AppKernel.php';

use AppKernel;
use Composer\Script\Event;
use PhpGitHooks\Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use PhpGitHooks\Module\Configuration\Contract\CommandHandler\ConfigurationProcessorCommandHandler;

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
            /** @var ConfigurationProcessorCommandHandler $processor */
            $processor = $container->get('command.bus');

            $processor->handle(new ConfigurationProcessorCommand($event->getIO()));
        }
    }
}
