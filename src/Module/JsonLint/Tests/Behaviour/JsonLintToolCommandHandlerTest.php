<?php

namespace Module\JsonLint\Tests\Behaviour;

use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Files\Contract\Query\JsonFilesExtractorQuery;
use Module\Files\Tests\Stub\JsonFilesResponseStub;
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
                ),
                $this->getJsonFilesExtractorQueryHandler()
            )
        );

        $this->errorMessage = ConfigurationDataResponseStub::FIX_YOUR_CODE;
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $files = FilesCommittedStub::createWithoutJsonFiles();

        $this->shouldHandleJsonFilesExtractorQuery(
            new JsonFilesExtractorQuery($files),
            JsonFilesResponseStub::createNoData()
        );

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand($files, $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldExecuteTool()
    {
        $files = JsonFilesResponseStub::createWithJsonData();

        $this->shouldHandleJsonFilesExtractorQuery(
            new JsonFilesExtractorQuery($files->getFiles()),
            $files
        );

        $this->shouldWriteOutput(JsonLintTool::CHECKING_MESSAGE);

        foreach ($files->getFiles() as $file) {
            $this->shouldProcessJsonLint($file, []);
        }
        $this->shouldWriteLnOutput(JsonLintTool::OK);

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand($files->getFiles(), $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(JsonLintViolationsException::class);

        $jsonFilesResponse = JsonFilesResponseStub::createWithJsonData();

        $this->shouldHandleJsonFilesExtractorQuery(
            new JsonFilesExtractorQuery($jsonFilesResponse->getFiles()),
            $jsonFilesResponse
        );
        $this->shouldWriteOutput(JsonLintTool::CHECKING_MESSAGE);

        foreach ($jsonFilesResponse->getFiles() as $file) {
            $this->shouldProcessJsonLint($file, $this->errorMessage);
        }

        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage));

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand($jsonFilesResponse->getFiles(), $this->errorMessage)
        );
    }
}
