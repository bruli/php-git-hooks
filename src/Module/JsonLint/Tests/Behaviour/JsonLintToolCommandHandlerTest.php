<?php

namespace Module\JsonLint\Tests\Behaviour;

use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\JsonLint\Contract\CommandHandler\JsonLintToolCommandHandler;
use Module\JsonLint\Contract\Exception\JsonLintViolationsException;
use Module\JsonLint\Service\JsonLintTool;
use Module\JsonLint\Service\JsonLintToolExecutor;
use Module\JsonLint\Tests\Infrastructure\JsonLintUnitTestCase;

class JsonLintToolCommandHandlerTest extends JsonLintUnitTestCase
{
    /**
     * @var JsonLintToolCommandHandler
     */
    private $jsonLintToolCommandHandler;
    /**
     * @var string
     */
    private $errorMessage;

    protected function setUp()
    {
        $this->jsonLintToolCommandHandler = new JsonLintToolCommandHandler(
            new JsonLintTool(
                $this->getOutputInterface(),
                new JsonLintToolExecutor(
                    $this->getJsonLintProcessor(),
                    $this->getOutputInterface()
                )
            )
        );

        $this->errorMessage = ConfigurationDataResponseStub::FIX_YOUR_CODE;
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand(FilesCommittedStub::createWithoutJsonFiles(), $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldExecuteTool()
    {
        $files = FilesCommittedStub::createAllFiles();

        $this->shouldWriteOutput(JsonLintTool::CHECKING_MESSAGE);

        foreach ($files as $file) {
            $this->shouldProcessJsonLint($file, []);
        }

        $this->shouldWriteLnOutput(JsonLintTool::OK);

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand($files, $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(JsonLintViolationsException::class);

        $files = FilesCommittedStub::createAllFiles();

        $this->shouldWriteOutput(JsonLintTool::CHECKING_MESSAGE);
        
        foreach ($files as $file) {
            $this->shouldProcessJsonLint($file, 'error_text');
        }

        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage));

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand($files, $this->errorMessage)
        );
    }
}
