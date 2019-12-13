<?php

namespace PhpGitHooks\Module\PhpMd\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Stub\PhpMdOptionsStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdTool;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdToolHandler;
use PhpGitHooks\Module\PhpMd\Contract\Exception\PhpMdViolationsException;
use PhpGitHooks\Module\PhpMd\Tests\Infrastructure\PhpMdUnitTestCase;

class PhpMdToolHandlerTest extends PhpMdUnitTestCase
{
    /**
     * @var PhpMdToolHandler
     */
    private $phpMdToolCommandHandler;

    protected function setUp(): void
    {
        $this->phpMdToolCommandHandler = new PhpMdToolHandler(
            $this->getOutputInterface(),
            $this->getPhpMdToolProcessor()
        );
    }

    /**
     * @test
     * @throws PhpMdViolationsException
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpMdViolationsException::class);

        $phpMdOptions = PhpMdOptionsStub::random();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();

        $outputMessage = new PreCommitOutputWriter(PhpMdToolHandler::CHECKING_MESSAGE);
        $this->shouldWriteOutput($outputMessage->getMessage());

        $errorsText = null;
        foreach ($phpFiles as $phpFile) {
            $error = 'ERROR';
            $this->shouldProcessPhpMdTool($phpFile, $phpMdOptions->value(), $error);
            $errorsText .= $error;
        }

        $this->shouldWriteLnOutput($outputMessage->getFailMessage());
        $this->shouldWriteLnOutput($outputMessage->setError($errorsText));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage, true));

        $command = new PhpMdTool($phpFiles, $phpMdOptions->value(), $errorMessage, true);
        $this->phpMdToolCommandHandler->handle($command);
    }

    /**
     * @test
     * @throws PhpMdViolationsException
     */
    public function itShouldWorksFine()
    {
        $phpMdOptions = PhpMdOptionsStub::random();
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();

        $outputMessage = new PreCommitOutputWriter(PhpMdToolHandler::CHECKING_MESSAGE);
        $this->shouldWriteOutput($outputMessage->getMessage());

        foreach ($phpFiles as $phpFile) {
            $this->shouldProcessPhpMdTool($phpFile, $phpMdOptions->value(), null);
        }

        $this->shouldWriteLnOutput($outputMessage->getSuccessfulMessage());

        $command = new PhpMdTool($phpFiles, $phpMdOptions->value(), $errorMessage, true);
        $this->phpMdToolCommandHandler->handle($command);
    }
}
