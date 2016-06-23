<?php

namespace PhpGitHooks\Module\PhpLint\Contract\CommandHandler;

use CommandBus\CommandBus\CommandHandlerInterface;
use CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\PhpLint\Contract\Command\PhpLintToolCommand;
use PhpGitHooks\Module\PhpLint\Service\PhpLintTool;

class PhpLintToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpLintTool
     */
    private $phpLintTool;

    /**
     * PhpLintToolCommandHandler constructor.
     *
     * @param PhpLintTool $phpLintTool
     */
    public function __construct(PhpLintTool $phpLintTool)
    {
        $this->phpLintTool = $phpLintTool;
    }

    /**
     * @param CommandInterface|PhpLintToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->phpLintTool->execute($command->getFiles(), $command->getErrorMessage());
    }
}
