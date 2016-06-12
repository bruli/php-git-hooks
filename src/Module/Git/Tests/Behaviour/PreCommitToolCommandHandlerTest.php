<?php

namespace Module\Git\Tests\Behaviour;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Git\Contract\Command\PreCommitToolCommand;
use Module\Git\Contract\CommandHandler\PreCommitToolCommandHandler;
use Module\Git\Contract\Response\GoodJobLogoResponse;
use Module\Git\Service\PreCommitTool;
use Module\Git\Tests\Infrastructure\GitUnitTestCase;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\PhpCs\Contract\Command\PhpCsToolCommand;
use Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use Module\Tests\Infrastructure\Stub\StubCreator;

class PreCommitToolCommandHandlerTest extends GitUnitTestCase
{
    /**
     * @var PreCommitToolCommandHandler
     */
    private $preCommitToolCommandHandler;

    protected function setUp()
    {
        $this->preCommitToolCommandHandler = new PreCommitToolCommandHandler(
            new PreCommitTool(
                $this->getOutputInterface(),
                $this->getFilesCommittedExtractor(),
                $this->getQueryBus(),
                $this->getCommandBus()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldNoExecuteTools()
    {
        $this->shouldGetFilesCommitted([StubCreator::faker()->sha1]);
        $this->shouldWriteLnOutput(PreCommitTool::NO_FILES_CHANGED_MESSAGE);

        $this->preCommitToolCommandHandler->handle(new PreCommitToolCommand());
    }

    /**
     * @test
     */
    public function itShouldExecuteAllTools()
    {
        $files = FilesCommittedStub::createAllFiles();
        $configurationDataResponse = ConfigurationDataResponseStub::createAllEnabled();

        $this->shouldGetFilesCommitted($files);
        $this->shouldHandleQuery(new ConfigurationDataFinderQuery(), $configurationDataResponse);
        $this->shouldHandleCommand(new ComposerToolCommand($files, $configurationDataResponse->getErrorMessage()));
        $this->shouldHandleCommand(new JsonLintToolCommand($files, $configurationDataResponse->getErrorMessage()));
        $this->shouldHandleCommand(new PhpLintToolCommand($files, $configurationDataResponse->getErrorMessage()));
        $this->shouldHandleCommand(new PhpCsToolCommand($files, $configurationDataResponse->getPhpCsStandard()));
        $this->shouldHandleCommand(
            new PhpCsFixerToolCommand(
                $files,
                $configurationDataResponse->isPhpCsFixerPsr0(),
                $configurationDataResponse->isPhpCsFixerPsr1(),
                $configurationDataResponse->isPhpCsFixerPsr2(),
                $configurationDataResponse->isPhpCsFixerSymfony()
            )
        );
        $this->shouldHandleCommand(
            new PhpUnitToolCommand(
                $configurationDataResponse->isPhpunitRandomMode(),
                $configurationDataResponse->getPhpunitOptions()
            )
        );

        $this->shouldWriteLnOutput(GoodJobLogoResponse::paint($configurationDataResponse->getRightMessage()));

        $this->preCommitToolCommandHandler->handle(new PreCommitToolCommand());
    }
}
