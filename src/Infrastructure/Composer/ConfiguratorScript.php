<?php

namespace Infrastructure\Composer;

require_once __DIR__.'/../../../app/AppKernel.php';
use AppKernel;
use Composer\Script\Event;
use Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use Module\Configuration\Contract\CommandHandler\ConfigurationProcessorCommandHandler;
use SimpleBus\Message\Bus\MessageBus;

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
            $processor = $container->get('configuration.processor.command.handler');

            $processor->handle(new ConfigurationProcessorCommand($event->getIO()));
//            /** @var MessageBus $commandBus */
//            $commandBus = $container->get('command_bus');
//            $commandBus->handle(new ConfigurationProcessorCommand($event->getIO()));
        }
    }
}
