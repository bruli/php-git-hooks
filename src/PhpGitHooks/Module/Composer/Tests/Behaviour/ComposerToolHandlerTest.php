<?php

namespace PhpGitHooks\Module\Composer\Tests\Behaviour;

use PhpGitHooks\Module\Composer\Contract\Command\ComposerTool;
use PhpGitHooks\Module\Composer\Contract\Command\ComposerToolHandler;
use PhpGitHooks\Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
use PhpGitHooks\Module\Composer\Tests\Infrastructure\ComposerUnitTestCase;
use PhpGitHooks\Module\Configuration\Tests\Stub\PreCommitResponseStub;
use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractor;
use PhpGitHooks\Module\Files\Tests\Stub\ComposerFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class ComposerToolHandlerTest extends ComposerUnitTestCase
{
    /**
     * @var ComposerToolHandler
     */
    private $composerToolCommandHandler;
    /**
     * @var string
     */
    private $errorMessage;

    protected function setUp(): void
    {
        $this->errorMessage = PreCommitResponseStub::FIX_YOUR_CODE;
        $this->composerToolCommandHandler = new ComposerToolHandler(
            $this->getQueryBus(),
            $this->getOutputInterface()
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $files = FilesCommittedStub::createAllFiles();

        $output = new PreCommitOutputWriter(ComposerToolHandler::CHECKING_MESSAGE);
        $this->shouldWriteOutput($output->getMessage());
        $this->shouldHandleQuery(
            new ComposerFilesExtractor($files),
            ComposerFilesResponseStub::createValidData()
        );
        $this->shouldWriteLnOutput($output->getSuccessfulMessage());

        $this->composerToolCommandHandler->handle(
            new ComposerTool($files, $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldThrowException()
    {
        $this->expectException(ComposerFilesNotFoundException::class);

        $files = FilesCommittedStub::createInvalidComposerFiles();
        $output = new PreCommitOutputWriter(ComposerToolHandler::CHECKING_MESSAGE);

        $this->shouldWriteOutput($output->getMessage());
        $this->shouldHandleQuery(
            new ComposerFilesExtractor($files),
            ComposerFilesResponseStub::createInvalidData()
        );
        $this->shouldWriteLnOutput($output->getFailMessage());
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage));

        $this->composerToolCommandHandler->handle(
            new ComposerTool($files, $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteComposerTool()
    {
        $files = FilesCommittedStub::createWithoutComposerFiles();

        $this->shouldHandleQuery(
            new ComposerFilesExtractor($files),
            ComposerFilesResponseStub::createNoData()
        );

        $this->composerToolCommandHandler->handle(new ComposerTool($files, $this->errorMessage));
    }
}
