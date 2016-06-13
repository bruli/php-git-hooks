<?php

namespace Module\PhpLint\Tests\Behaviour;

use Module\Configuration\Service\HookQuestions;
use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Files\Contract\Query\PhpFilesExtractorQuery;
use Module\Files\Tests\Stub\PhpFilesResponseStub;
use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpLint\Contract\CommandHandler\PhpLintToolCommandHandler;
use Module\PhpLint\Contract\Exception\PhpLintViolationsException;
use Module\PhpLint\Service\PhpLintTool;
use Module\PhpLint\Service\PhpLintToolExecutor;
use Module\PhpLint\Tests\Infrastructure\PhpLintUnitTestCase;

class PhpLintToolCommandHandlerTest extends PhpLintUnitTestCase
{
    /**
     * @var PhpLintToolCommandHandler
     */
    private $phpLintToolCommandHandler;

    protected function setUp()
    {
        $this->phpLintToolCommandHandler = new PhpLintToolCommandHandler(
            new PhpLintTool(
                new PhpLintToolExecutor($this->getPhpLintToolProcessor(), $this->getOutputInterface()),
                $this->getQueryBus()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $files = FilesCommittedStub::createWithoutPhpFiles();
        
        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), PhpFilesResponseStub::create([]));

        $this->phpLintToolCommandHandler->handle(
            new PhpLintToolCommand($files, ConfigurationDataResponseStub::FIX_YOUR_CODE)
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpLintViolationsException::class);
        
        $files = FilesCommittedStub::createAllFiles();
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $outputMessage = new PreCommitOutputWriter(PhpLintToolExecutor::RUNNING_PHPLINT);
        $errorMessage = ConfigurationDataResponseStub::FIX_YOUR_CODE;
        
        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), PhpFilesResponseStub::create($phpFiles));
        $this->shouldWriteOutput($outputMessage->getMessage());
        
        $errors = null;
        foreach ($phpFiles as $file) {
            $error = 'ERROR';
            $this->shouldProcessPhpLintTool($file, $error);
            $errors .= $error;
        }
        
        $this->shouldWriteLnOutput($outputMessage->setError($errors));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage));

        $this->phpLintToolCommandHandler->handle(
            new PhpLintToolCommand($files, $errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $files = FilesCommittedStub::createAllFiles();
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();
        $outputMessage = new PreCommitOutputWriter(PhpLintToolExecutor::RUNNING_PHPLINT);

        $this->shouldHandleQuery(new PhpFilesExtractorQuery($files), PhpFilesResponseStub::create($phpFiles));
        $this->shouldWriteOutput($outputMessage->getMessage());

        foreach ($phpFiles as $file) {
            $this->shouldProcessPhpLintTool($file, null);
        }

        $this->shouldWriteLnOutput($outputMessage->getSuccessfulMessage());

        $this->phpLintToolCommandHandler->handle(
            new PhpLintToolCommand($files, HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT)
        );
    }
}
