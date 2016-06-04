<?php

namespace Module\JsonLint\Tests\Behaviour;

use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\JsonLint\Contract\CommandHandler\JsonLintToolCommandHandler;
use Module\JsonLint\Service\JsonLintTool;
use Module\JsonLint\Tests\Infrastructure\JsonLintUnitTestCase;

class JsonLintToolCommandHandlerTest extends JsonLintUnitTestCase
{
    /**
     * @var JsonLintToolCommandHandler
     */
    private $jsonLintToolCommandHandler;

    protected function setUp()
    {
        $this->jsonLintToolCommandHandler = new JsonLintToolCommandHandler(
            new JsonLintTool($this->getOutputInterface())
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand(FilesCommittedStub::createWithoutJsonFiles())
        );
    }

    /**
     * @test
     */
    public function itShouldExecuteTool()
    {
        $this->shouldWriteOutput(JsonLintTool::CHECKING_MESSAGE);
        $this->shouldWriteLnOutput(JsonLintTool::OK);

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand(FilesCommittedStub::createAllFiles())
        );
    }
}
