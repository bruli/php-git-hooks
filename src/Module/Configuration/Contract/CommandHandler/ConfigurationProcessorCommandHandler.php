<?php

namespace Module\Configuration\Contract\CommandHandler;

use Module\Configuration\Contract\Command\ConfigurationProcessorCommand;
use Module\Configuration\Service\ConfigurationProcessor;

class ConfigurationProcessorCommandHandler
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
        var_dump('hola'); die;
        $this->configurationProcessor = $configurationProcessor;
    }

    /**
     * @param ConfigurationProcessorCommand $configuratorProcessorCommand
     */
    public function handle(ConfigurationProcessorCommand $configuratorProcessorCommand)
    {
        $this->configurationProcessor->process($configuratorProcessorCommand->getIOInterface());
    }
}
