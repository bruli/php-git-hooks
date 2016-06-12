<?php

namespace Module\PhpCs\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpCs\Contract\Command\PhpCsToolCommand;
use Module\PhpCs\Service\PhpCsTool;
use Module\PhpCs\Service\PhpCsToolExecutor;

class PhpCsToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpCsTool
     */
    private $phpCsTool;

    /**
     * PhpCsToolCommandHandler constructor.
     * @param PhpCsTool $phpCsTool
     */
    public function __construct(PhpCsTool $phpCsTool)
    {
        $this->phpCsTool = $phpCsTool;
    }

    /**
     * @param CommandInterface|PhpCsToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->phpCsTool->execute($command->getFiles(), $command->getStandard(), $command->getErrorMessage());
    }
}
