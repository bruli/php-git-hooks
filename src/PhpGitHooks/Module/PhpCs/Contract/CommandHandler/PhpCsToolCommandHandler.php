<?php

namespace PhpGitHooks\Module\PhpCs\Contract\CommandHandler;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandHandlerInterface;
use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsToolCommand;
use PhpGitHooks\Module\PhpCs\Service\PhpCsTool;

class PhpCsToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpCsTool
     */
    private $phpCsTool;

    /**
     * PhpCsToolCommandHandler constructor.
     *
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
