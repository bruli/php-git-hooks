<?php

namespace Module\JsonLint\Contract\CommandHandler;

use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\JsonLint\Service\JsonLintTool;

class JsonLintToolCommandHandler
{
    /**
     * @var JsonLintTool
     */
    private $jsonLintTool;

    /**
     * JsonLintToolCommandHandler constructor.
     * @param JsonLintTool $jsonLintTool
     */
    public function __construct(JsonLintTool $jsonLintTool)
    {
        $this->jsonLintTool = $jsonLintTool;
    }

    /**
     * @param JsonLintToolCommand $jsonLintToolCommand
     */
    public function handle(JsonLintToolCommand $jsonLintToolCommand)
    {
        $this->jsonLintTool->execute($jsonLintToolCommand->getFiles());
    }
}
