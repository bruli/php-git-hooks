<?php

namespace Module\PhpMd\Tests\Behaviour;

use Module\Configuration\Service\HookQuestions;
use Module\Files\Contract\Query\PhpFilesExtractorQuery;
use Module\Files\Tests\Stub\PhpFilesResponseStub;
use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\PhpMd\Contract\Command\PhpMdToolCommand;
use Module\PhpMd\Contract\CommandHandler\PhpMdToolCommandHandler;
use Module\PhpMd\Contract\Exception\PhpMdViolationsException;
use Module\PhpMd\Service\PhpMdTool;
use Module\PhpMd\Service\PhpMdToolExecutor;
use Module\PhpMd\Tests\Infrastructure\PhpMdUnitTestCase;

class PhpMdToolCommandHandlerTest extends PhpMdUnitTestCase
{
    /**
     * @var PhpMdToolCommandHandler
     */
    private $phpMdToolCommandHandler;

    protected function setUp()
    {
        $this->phpMdToolCommandHandler = new PhpMdToolCommandHandler(
            new PhpMdTool(
                $this->getQueryBus(),
                new PhpMdToolExecutor(
                    $this->getOutputInterface(),
                    $this->getPhpMdToolProcessor()
                )
            )
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $files = FilesCommittedStub::createWithoutPhpFiles();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), PhpFilesResponseStub::create([]));

        $command = new PhpMdToolCommand($files, $errorMessage);
        $this->phpMdToolCommandHandler->handle($command);
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpMdViolationsException::class);

        $files = FilesCommittedStub::createAllFiles();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $phpFilesResponse = PhpFilesResponseStub::create($phpFiles);

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), $phpFilesResponse);
        $outputMessage = new PreCommitOutputWriter(PhpMdToolExecutor::CHECKING_MESSAGE);
        $this->shouldWriteOutput($outputMessage->getMessage());

        $errorsText = null;
        foreach ($phpFiles as $phpFile) {
            $error = 'ERROR';
            $this->shouldProcessPhpMdTool($phpFile, $error);
            $errorsText .= $error;
        }
        
        $this->shouldWriteLnOutput($outputMessage->getFailMessage());
        $this->shouldWriteLnOutput($outputMessage->setError($errorsText));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage));

        $command = new PhpMdToolCommand($files, $errorMessage);
        $this->phpMdToolCommandHandler->handle($command);
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $files = FilesCommittedStub::createAllFiles();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $phpFilesResponse = PhpFilesResponseStub::create($phpFiles);

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), $phpFilesResponse);
        $outputMessage = new PreCommitOutputWriter(PhpMdToolExecutor::CHECKING_MESSAGE);
        $this->shouldWriteOutput($outputMessage->getMessage());

        foreach ($phpFiles as $phpFile) {
            $this->shouldProcessPhpMdTool($phpFile, null);
        }

        $this->shouldWriteLnOutput($outputMessage->getSuccessfulMessage());

        $command = new PhpMdToolCommand($files, $errorMessage);
        $this->phpMdToolCommandHandler->handle($command);
    }
}
