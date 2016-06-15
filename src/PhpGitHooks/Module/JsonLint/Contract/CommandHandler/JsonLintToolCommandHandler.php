<?php

namespace PhpGitHooks\Module\JsonLint\Contract\CommandHandler;

use CommandBus\CommandBus\CommandHandlerInterface;
use CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintToolCommand;
use PhpGitHooks\Module\JsonLint\Service\JsonLintTool;

class JsonLintToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var JsonLintTool
     */
    private $jsonLintTool;

    /**
     * JsonLintToolCommandHandler constructor.
     *
     * @param JsonLintTool $jsonLintTool
     */
    public function __construct(JsonLintTool $jsonLintTool)
    {
        $this->jsonLintTool = $jsonLintTool;
    }

    /**
     * @param CommandInterface|JsonLintToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->jsonLintTool->execute($command->getFiles(), $command->getErrorMessage());
    }
}
