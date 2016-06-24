<?php

namespace PhpGitHooks\Module\JsonLint\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitResponseStub;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractorQuery;
use PhpGitHooks\Module\Files\Tests\Stub\JsonFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintToolCommand;
use PhpGitHooks\Module\JsonLint\Contract\CommandHandler\JsonLintToolCommandHandler;
use PhpGitHooks\Module\JsonLint\Contract\Exception\JsonLintViolationsException;
use PhpGitHooks\Module\JsonLint\Service\JsonLintTool;
use PhpGitHooks\Module\JsonLint\Service\JsonLintToolExecutor;
use PhpGitHooks\Module\JsonLint\Tests\Infrastructure\JsonLintUnitTestCase;

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
                new JsonLintToolExecutor(
                    $this->getJsonLintProcessor(),
                    $this->getOutputInterface()
                ),
                $this->getQueryBus()
            )
        );

        $this->errorMessage = PreCommitResponseStub::FIX_YOUR_CODE;
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $files = FilesCommittedStub::createWithoutJsonFiles();

        $this->shouldHandleQuery(
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
        $output = new PreCommitOutputWriter(JsonLintToolExecutor::CHECKING_MESSAGE);

        $this->shouldHandleQuery(
            new JsonFilesExtractorQuery($files->getFiles()),
            $files
        );

        $this->shouldWriteOutput($output->getMessage());

        foreach ($files->getFiles() as $file) {
            $this->shouldProcessJsonLint($file, []);
        }
        $this->shouldWriteLnOutput($output->getSuccessfulMessage());

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
        $output = new PreCommitOutputWriter(JsonLintToolExecutor::CHECKING_MESSAGE);

        $jsonFilesResponse = JsonFilesResponseStub::createWithJsonData();

        $this->shouldHandleQuery(
            new JsonFilesExtractorQuery($jsonFilesResponse->getFiles()),
            $jsonFilesResponse
        );
        $this->shouldWriteOutput($output->getMessage());

        $errorTxt = null;
        foreach ($jsonFilesResponse->getFiles() as $file) {
            $error = 'ERROR';
            $this->shouldProcessJsonLint($file, $error);
            $errorTxt .= $error;
        }

        $this->shouldWriteLnOutput($output->getFailMessage());
        $this->shouldWriteLnOutput($output->setError($errorTxt));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage));

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintToolCommand($jsonFilesResponse->getFiles(), $this->errorMessage)
        );
    }
}
