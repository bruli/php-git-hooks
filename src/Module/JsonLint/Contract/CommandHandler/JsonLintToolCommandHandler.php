<?php

namespace Module\JsonLint\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\JsonLint\Service\JsonLintTool;

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
