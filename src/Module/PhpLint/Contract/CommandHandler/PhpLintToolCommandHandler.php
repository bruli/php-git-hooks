<?php

namespace Module\PhpLint\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpLint\Service\PhpLintTool;

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
