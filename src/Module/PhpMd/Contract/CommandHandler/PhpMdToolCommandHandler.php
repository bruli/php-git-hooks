<?php

namespace Module\PhpMd\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpMd\Contract\Command\PhpMdToolCommand;
use Module\PhpMd\Service\PhpMdTool;

class PhpMdToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpMdTool
     */
    private $phpMdTool;

    /**
     * PhpMdToolCommandHandler constructor.
     *
     * @param PhpMdTool $phpMdTool
     */
    public function __construct(PhpMdTool $phpMdTool)
    {
        $this->phpMdTool = $phpMdTool;
    }

    /**
     * @param CommandInterface|PhpMdToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->phpMdTool->execute($command->getFiles(), $command->getErrorMessage());
    }
}
