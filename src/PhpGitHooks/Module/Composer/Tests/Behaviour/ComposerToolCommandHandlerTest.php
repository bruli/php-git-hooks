<?php

namespace PhpGitHooks\Module\Composer\Tests\Behaviour;

use PhpGitHooks\Module\Composer\Contract\Command\ComposerToolCommand;
use PhpGitHooks\Module\Composer\Contract\CommandHandler\ComposerToolCommandHandler;
use PhpGitHooks\Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
use PhpGitHooks\Module\Composer\Service\ComposerTool;
use PhpGitHooks\Module\Composer\Tests\Infrastructure\ComposerUnitTestCase;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use PhpGitHooks\Module\Files\Tests\Stub\ComposerFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class ComposerToolCommandHandlerTest extends ComposerUnitTestCase
{
    /**
     * @var ComposerToolCommandHandler
     */
    private $composerToolCommandHandler;
    /**
     * @var string
     */
    private $errorMessage;

    protected function setUp()
    {
        $this->errorMessage = ConfigurationDataResponseStub::FIX_YOUR_CODE;
        $this->composerToolCommandHandler = new ComposerToolCommandHandler(
            new ComposerTool(
                $this->getQueryBus(),
                $this->getOutputInterface()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $files = FilesCommittedStub::createAllFiles();

        $output = new PreCommitOutputWriter(ComposerTool::CHECKING_MESSAGE);
        $this->shouldWriteOutput($output->getMessage());
        $this->shouldHandleQuery(
            new ComposerFilesExtractorQuery($files),
            ComposerFilesResponseStub::createValidData()
        );
        $this->shouldWriteLnOutput($output->getSuccessfulMessage());

        $this->composerToolCommandHandler->handle(
            new ComposerToolCommand($files, $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldThrowException()
    {
        $this->expectException(ComposerFilesNotFoundException::class);

        $files = FilesCommittedStub::createInvalidComposerFiles();
        $output = new PreCommitOutputWriter(ComposerTool::CHECKING_MESSAGE);

        $this->shouldWriteOutput($output->getMessage());
        $this->shouldHandleQuery(
            new ComposerFilesExtractorQuery($files),
            ComposerFilesResponseStub::createInvalidData()
        );
        $this->shouldWriteLnOutput($output->getFailMessage());
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage));

        $this->composerToolCommandHandler->handle(
            new ComposerToolCommand($files, $this->errorMessage)
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteComposerTool()
    {
        $files = FilesCommittedStub::createWithoutComposerFiles();

        $this->shouldHandleQuery(
            new ComposerFilesExtractorQuery($files),
            ComposerFilesResponseStub::createNoData()
        );

        $this->composerToolCommandHandler->handle(new ComposerToolCommand($files, $this->errorMessage));
    }
}
