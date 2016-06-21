<?php

namespace PhpGitHooks\Module\PhpCs\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Tests\Stub\PhpFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsToolCommand;
use PhpGitHooks\Module\PhpCs\Contract\CommandHandler\PhpCsToolCommandHandler;
use PhpGitHooks\Module\PhpCs\Contract\Exception\PhpCsViolationException;
use PhpGitHooks\Module\PhpCs\Service\PhpCsTool;
use PhpGitHooks\Module\PhpCs\Service\PhpCsToolExecutor;
use PhpGitHooks\Module\PhpCs\Tests\Infrastructure\PhpCsUnitTestCase;

class PhpCsToolCommandHandlerTest extends PhpCsUnitTestCase
{
    /**
     * @var PhpCsToolCommandHandler
     */
    private $phpCsToolCommandHandler;

    protected function setUp()
    {
        $this->phpCsToolCommandHandler = new PhpCsToolCommandHandler(
            new PhpCsTool(
                new PhpCsToolExecutor(
                    $this->getOutputInterface(),
                    $this->getPhpCsToolProcessor()
                ),
                $this->getQueryBus()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpCsViolationException::class);

        $output = new PreCommitOutputWriter(PhpCsToolExecutor::EXECUTE_MESSAGE);
        $files = FilesCommittedStub::createOnlyPhpFiles();

        $this->shouldHandleQuery(
            new PhpFilesExtractorQuery(FilesCommittedStub::createAllFiles()),
            PhpFilesResponseStub::create($files)
        );
        $this->shouldWriteOutput($output->getMessage());

        $errorTxt = null;
        foreach ($files as $file) {
            $error = 'ERROR-';
            $this->shouldProcessPhpCsTool($file, 'PSR2', $error);
            $errorTxt .= $error;
        }

        $this->shouldWriteLnOutput($output->getFailMessage());
        $this->shouldWriteLnOutput($output->setError($errorTxt));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint(HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT));

        $this->phpCsToolCommandHandler->handle(
            new PhpCsToolCommand(
                FilesCommittedStub::createAllFiles(),
                'PSR2',
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT
            )
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $this->shouldHandleQuery(
            new PhpFilesExtractorQuery(FilesCommittedStub::createWithoutJsonFiles()),
            PhpFilesResponseStub::create([])
        );

        $this->phpCsToolCommandHandler->handle(
            new PhpCsToolCommand(
                FilesCommittedStub::createAllFiles(),
                'PSR2',
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT
            )
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $output = new PreCommitOutputWriter(PhpCsToolExecutor::EXECUTE_MESSAGE);
        $files = FilesCommittedStub::createOnlyPhpFiles();

        $this->shouldHandleQuery(
            new PhpFilesExtractorQuery(FilesCommittedStub::createAllFiles()),
            PhpFilesResponseStub::create($files)
        );
        $this->shouldWriteOutput($output->getMessage());

        foreach ($files as $file) {
            $this->shouldProcessPhpCsTool($file, 'PSR2', null);
        }

        $this->shouldWriteLnOutput($output->getSuccessfulMessage());

        $this->phpCsToolCommandHandler->handle(
            new PhpCsToolCommand(
                FilesCommittedStub::createAllFiles(),
                'PSR2',
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT
            )
        );
    }
}
