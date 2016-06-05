<?php

namespace Module\PhpLint\Contract\CommandHandler;

use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpLint\Service\PhpLintTool;

class PhpLintToolCommandHandler
{
    /**
     * @var PhpLintTool
     */
    private $phpLintTool;

    /**
     * PhpLintToolCommandHandler constructor.
     * @param PhpLintTool $phpLintTool
     */
    public function __construct(PhpLintTool $phpLintTool)
    {
        $this->phpLintTool = $phpLintTool;
    }

    /**
     * @param PhpLintToolCommand $phpLintToolCommand
     */
    public function handle(PhpLintToolCommand $phpLintToolCommand)
    {
        $this->phpLintTool->execute($phpLintToolCommand->getFiles(), $phpLintToolCommand->getErrorMessage());
    }
}
