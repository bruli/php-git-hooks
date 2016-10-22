<?php

namespace PhpGitHooks\Module\Configuration\Contract\CommandHandler;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use PhpGitHooks\Module\Configuration\Service\ConfigurationProcessor;

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
        $this->configurationProcessor->process($command->getInput());
    }
}
