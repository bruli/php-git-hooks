<?php

namespace PhpGitHooks\Module\JsonLint\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitResponseStub;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractor;
use PhpGitHooks\Module\Files\Tests\Stub\JsonFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintTool;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintToolHandler;
use PhpGitHooks\Module\JsonLint\Contract\Exception\JsonLintViolationsException;
use PhpGitHooks\Module\JsonLint\Service\JsonLintToolExecutor;
use PhpGitHooks\Module\JsonLint\Tests\Infrastructure\JsonLintUnitTestCase;

class JsonLintToolHandlerTest extends JsonLintUnitTestCase
{
    /**
     * @var JsonLintToolHandler
     */
    private $jsonLintToolCommandHandler;
    /**
     * @var string
     */
    private $errorMessage;

    protected function setUp()
    {
        $this->jsonLintToolCommandHandler = new JsonLintToolHandler(
            new JsonLintToolExecutor(
                $this->getJsonLintProcessor(),
                $this->getOutputInterface()
            ),
            $this->getQueryBus()
        );

        $this->errorMessage = PreCommitResponseStub::FIX_YOUR_CODE;
    }

    /**
     * @test
     * @throws JsonLintViolationsException
     */
    public function itShouldNotExecuteTool()
    {
        $files = FilesCommittedStub::createWithoutJsonFiles();

        $this->shouldHandleQuery(
            new JsonFilesExtractor($files),
            JsonFilesResponseStub::createNoData()
        );

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintTool($files, $this->errorMessage, true)
        );
    }

    /**
     * @test
     * @throws JsonLintViolationsException
     */
    public function itShouldExecuteTool()
    {
        $files = JsonFilesResponseStub::createWithJsonData();
        $output = new PreCommitOutputWriter(JsonLintToolExecutor::CHECKING_MESSAGE);

        $this->shouldHandleQuery(
            new JsonFilesExtractor($files->getFiles()),
            $files
        );

        $this->shouldWriteOutput($output->getMessage());

        foreach ($files->getFiles() as $file) {
            $this->shouldProcessJsonLint($file, null);
        }
        $this->shouldWriteLnOutput($output->getSuccessfulMessage());

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintTool($files->getFiles(), $this->errorMessage, true)
        );
    }

    /**
     * @test
     * @throws JsonLintViolationsException
     */
    public function itShouldThrowsException()
    {
        $this->expectException(JsonLintViolationsException::class);
        $output = new PreCommitOutputWriter(JsonLintToolExecutor::CHECKING_MESSAGE);

        $jsonFilesResponse = JsonFilesResponseStub::createWithJsonData();

        $this->shouldHandleQuery(
            new JsonFilesExtractor($jsonFilesResponse->getFiles()),
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
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage, true));

        $this->jsonLintToolCommandHandler->handle(
            new JsonLintTool($jsonFilesResponse->getFiles(), $this->errorMessage, true)
        );
    }
}
