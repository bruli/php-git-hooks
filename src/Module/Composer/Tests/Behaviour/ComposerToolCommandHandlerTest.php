<?php

namespace Module\Composer\Tests\Behaviour;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Contract\CommandHandler\ComposerToolCommandHandler;
use Module\Composer\Contract\Exception\ComposerFilesNotFoundException;
use Module\Composer\Service\ComposerTool;
use Module\Composer\Tests\Infrastructure\ComposerUnitTestCase;
use Module\Git\Tests\Stub\FilesCommittedStub;

class ComposerToolCommandHandlerTest extends ComposerUnitTestCase
{
    /**
     * @var ComposerToolCommandHandler
     */
    private $composerToolCommandHandler;

    protected function setUp()
    {
        $this->composerToolCommandHandler = new ComposerToolCommandHandler(
            new ComposerTool($this->getOutputInterface())
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $files = FilesCommittedStub::createAllFiles();

        $this->shouldWriteOutput(ComposerTool::CHECKING_MESAGE);
        $this->shouldWriteLnOutput(ComposerTool::OK);

        $this->composerToolCommandHandler->handle(new ComposerToolCommand($files));
    }

    /**
     * @test
     */
    public function itShouldThrowException()
    {
        $this->expectException(ComposerFilesNotFoundException::class);

        $files = FilesCommittedStub::createInvalidComposerFiles();

        $this->shouldWriteOutput(ComposerTool::CHECKING_MESAGE);

        $this->composerToolCommandHandler->handle(new ComposerToolCommand($files));
    }

    /**
     * @test
     */
    public function itShouldNotExecuteComposerTool()
    {
        $files = FilesCommittedStub::createWithoutComposerFiles();
        $this->composerToolCommandHandler->handle(new ComposerToolCommand($files));
    }
}
