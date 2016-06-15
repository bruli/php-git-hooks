<?php

namespace Module\Composer\Tests\Behaviour;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Contract\CommandHandler\ComposerToolCommandHandler;
use Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
use Module\Composer\Service\ComposerTool;
use Module\Composer\Tests\Infrastructure\ComposerUnitTestCase;
use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use Module\Files\Tests\Stub\ComposerFilesResponseStub;
use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\Git\Tests\Stub\FilesCommittedStub;

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
                $this->getComposerFilesExtractorQueryHandler(),
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
        $this->shouldHandleComposerFilesExtractorQuery(
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
        $this->shouldHandleComposerFilesExtractorQuery(
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

        $this->shouldHandleComposerFilesExtractorQuery(
            new ComposerFilesExtractorQuery($files),
            ComposerFilesResponseStub::createNoData()
        );

        $this->composerToolCommandHandler->handle(new ComposerToolCommand($files, $this->errorMessage));
    }
}
