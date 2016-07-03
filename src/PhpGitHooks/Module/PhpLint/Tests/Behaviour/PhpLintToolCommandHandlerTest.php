<?php

namespace PhpGitHooks\Module\PhpLint\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\PhpLint\Contract\Command\PhpLintToolCommand;
use PhpGitHooks\Module\PhpLint\Contract\CommandHandler\PhpLintToolCommandHandler;
use PhpGitHooks\Module\PhpLint\Contract\Exception\PhpLintViolationsException;
use PhpGitHooks\Module\PhpLint\Service\PhpLintTool;
use PhpGitHooks\Module\PhpLint\Tests\Infrastructure\PhpLintUnitTestCase;

class PhpLintToolCommandHandlerTest extends PhpLintUnitTestCase
{
    /**
     * @var PhpLintToolCommandHandler
     */
    private $phpLintToolCommandHandler;

    protected function setUp()
    {
        $this->phpLintToolCommandHandler = new PhpLintToolCommandHandler(
            new PhpLintTool($this->getPhpLintToolProcessor(), $this->getOutputInterface())
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpLintViolationsException::class);

        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $outputMessage = new PreCommitOutputWriter(PhpLintTool::RUNNING_PHPLINT);
        $errorMessage = PreCommitResponseStub::FIX_YOUR_CODE;

        $this->shouldWriteOutput($outputMessage->getMessage());

        $errors = null;
        foreach ($phpFiles as $file) {
            $error = 'ERROR';
            $this->shouldProcessPhpLintTool($file, $error);
            $errors .= $error;
        }

        $this->shouldWriteLnOutput($outputMessage->getFailMessage());
        $this->shouldWriteLnOutput($outputMessage->setError($errors));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage));

        $this->phpLintToolCommandHandler->handle(
            new PhpLintToolCommand($phpFiles, $errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $outputMessage = new PreCommitOutputWriter(PhpLintTool::RUNNING_PHPLINT);

        $this->shouldWriteOutput($outputMessage->getMessage());

        foreach ($phpFiles as $file) {
            $this->shouldProcessPhpLintTool($file, null);
        }

        $this->shouldWriteLnOutput($outputMessage->getSuccessfulMessage());

        $this->phpLintToolCommandHandler->handle(
            new PhpLintToolCommand($phpFiles, HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT)
        );
    }
}
