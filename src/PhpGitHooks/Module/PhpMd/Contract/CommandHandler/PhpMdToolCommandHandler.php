<?php

namespace PhpGitHooks\Module\PhpMd\Contract\CommandHandler;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdToolCommand;
use PhpGitHooks\Module\PhpMd\Service\PhpMdTool;

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
        $this->phpMdTool->execute($command->getFiles(), $command->getOptions(), $command->getErrorMessage());
    }
}
