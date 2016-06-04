<?php

namespace Module\Git\Tests\Behaviour;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Git\Contract\Command\PreCommitToolCommand;
use Module\Git\Contract\CommandHandler\PreCommitToolCommandHandler;
use Module\Git\Service\PreCommitTool;
use Module\Git\Tests\Infrastructure\GitUnitTestCase;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\PhpCs\Contract\Command\PhpCsToolCommand;
use Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpUnit\Contract\Command\PhpUnitToolCommand;

class PreCommitToolCommandHandlerTest extends GitUnitTestCase
{
    /**
     * @var PreCommitToolCommandHandler
     */
    private $preCommitToolCommandHandler;
    /**
     * @var PreCommitToolCommand
     */
    private $preCommitToolCommand;

    protected function setUp()
    {
        $this->preCommitToolCommandHandler = new PreCommitToolCommandHandler(
            new PreCommitTool(
                $this->getFilesCommittedExtractor(),
                $this->getConfigurationDataFinderQueryHandler(),
                $this->getComposerToolCommandHandler(),
                $this->getJsonLintToolCommandHandler(),
                $this->getPhpLintToolCommandHandler(),
                $this->getPhpCsToolCommandHandler(),
                $this->getPhpCsFixerToolCommandHandler(),
                $this->getPhpUnitToolCommandHandler()
            )
        );

        $this->preCommitToolCommand = new PreCommitToolCommand($this->getOutputInterface());
    }

    /**
     * @test
     */
    public function itShouldNoExecuteTools()
    {
        $this->shouldGetFilesCommitted([]);
        $this->shouldWriteLnOutput(PreCommitTool::NO_FILES_CHANGED_MESSAGE);

        $this->preCommitToolCommandHandler->handle($this->preCommitToolCommand);
    }

    /**
     * @test
     */
    public function itShouldExecuteAllTools()
    {
        $files = FilesCommittedStub::createAllFiles();
        $configurationDataResponse = ConfigurationDataResponseStub::createAllEnabled();

        $this->shouldGetFilesCommitted($files);
        $this->shouldHandleConfigurationDataQuery($configurationDataResponse);
        $this->shouldHandleComposerToolCommand(
            new ComposerToolCommand($files, $configurationDataResponse->getErrorMessage())
        );
        $this->shouldHandleJsonLintToolCommand(new JsonLintToolCommand($files));
        $this->shouldHandlePhpLintToolCommand(new PhpLintToolCommand($files));
        $this->shouldHandlePhpCsToolCommand(
            new PhpCsToolCommand($files, $configurationDataResponse->getPhpCsStandard())
        );
        $this->shouldHandlePhpCsFixerToolCommand(
            new PhpCsFixerToolCommand(
                $files,
                $configurationDataResponse->isPhpCsFixerPsr0(),
                $configurationDataResponse->isPhpCsFixerPsr1(),
                $configurationDataResponse->isPhpCsFixerPsr2(),
                $configurationDataResponse->isPhpCsFixerSymfony()
            )
        );

        $this->shouldHandlePhpUnitToolCommand(
            new PhpUnitToolCommand(
                $configurationDataResponse->isPhpunitRandomMode(),
                $configurationDataResponse->getPhpunitOptions()
            )
        );

        $this->shouldWriteLnOutput(PreCommitTool::OK_MESSAGE);

        $this->preCommitToolCommandHandler->handle($this->preCommitToolCommand);
    }
}
