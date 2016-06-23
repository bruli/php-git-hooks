<?php

namespace PhpGitHooks\Module\PhpMd\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Stub\PhpMdOptionsStub;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Tests\Stub\PhpFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdToolCommand;
use PhpGitHooks\Module\PhpMd\Contract\CommandHandler\PhpMdToolCommandHandler;
use PhpGitHooks\Module\PhpMd\Contract\Exception\PhpMdViolationsException;
use PhpGitHooks\Module\PhpMd\Service\PhpMdTool;
use PhpGitHooks\Module\PhpMd\Service\PhpMdToolExecutor;
use PhpGitHooks\Module\PhpMd\Tests\Infrastructure\PhpMdUnitTestCase;

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
        $phpMdOptions = PhpMdOptionsStub::random();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), PhpFilesResponseStub::create([]));

        $command = new PhpMdToolCommand($files, $phpMdOptions->value(), $errorMessage);
        $this->phpMdToolCommandHandler->handle($command);
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpMdViolationsException::class);

        $files = FilesCommittedStub::createAllFiles();
        $phpMdOptions = PhpMdOptionsStub::random();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $phpFilesResponse = PhpFilesResponseStub::create($phpFiles);

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), $phpFilesResponse);
        $outputMessage = new PreCommitOutputWriter(PhpMdToolExecutor::CHECKING_MESSAGE);
        $this->shouldWriteOutput($outputMessage->getMessage());

        $errorsText = null;
        foreach ($phpFiles as $phpFile) {
            $error = 'ERROR';
            $this->shouldProcessPhpMdTool($phpFile, $phpMdOptions->value(), $error);
            $errorsText .= $error;
        }
        
        $this->shouldWriteLnOutput($outputMessage->getFailMessage());
        $this->shouldWriteLnOutput($outputMessage->setError($errorsText));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage));

        $command = new PhpMdToolCommand($files, $phpMdOptions->value(), $errorMessage);
        $this->phpMdToolCommandHandler->handle($command);
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $files = FilesCommittedStub::createAllFiles();
        $phpMdOptions = PhpMdOptionsStub::random();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $phpFilesResponse = PhpFilesResponseStub::create($phpFiles);

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), $phpFilesResponse);
        $outputMessage = new PreCommitOutputWriter(PhpMdToolExecutor::CHECKING_MESSAGE);
        $this->shouldWriteOutput($outputMessage->getMessage());

        foreach ($phpFiles as $phpFile) {
            $this->shouldProcessPhpMdTool($phpFile, $phpMdOptions->value(), null);
        }

        $this->shouldWriteLnOutput($outputMessage->getSuccessfulMessage());

        $command = new PhpMdToolCommand($files, $phpMdOptions->value(), $errorMessage);
        $this->phpMdToolCommandHandler->handle($command);
    }
}
