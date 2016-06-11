<?php

namespace Module\Configuration\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use Module\Configuration\Service\ConfigurationProcessor;

class ConfigurationProcessorCommandHandler implements CommandHandlerInterface
{
    /**
     * @var ConfigurationProcessor
     */
    private $configurationProcessor;

    /**
     * ConfigurationProcessorCommandHandler constructor.
     *
     * @param ConfigurationProcessor $configurationProcessor
     */
    public function __construct(ConfigurationProcessor $configurationProcessor)
    {
        $this->configurationProcessor = $configurationProcessor;
    }

    /**
     * @param CommandInterface|ConfigurationProcessorCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->configurationProcessor->process($command->getIOInterface());
    }
}
