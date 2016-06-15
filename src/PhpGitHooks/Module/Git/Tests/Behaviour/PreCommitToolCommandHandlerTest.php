<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Composer\Contract\Command\ComposerToolCommand;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Git\Contract\Command\PreCommitToolCommand;
use PhpGitHooks\Module\Git\Contract\CommandHandler\PreCommitToolCommandHandler;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitTool;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintToolCommand;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsToolCommand;
use PhpGitHooks\Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use PhpGitHooks\Module\PhpLint\Contract\Command\PhpLintToolCommand;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdToolCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

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
                $this->getCommandBus(),
                $this->getToolTitleOutputWriter()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTools()
    {
        $this->shouldWriteTitle(PreCommitTool::TITLE, 'title');
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

        $this->shouldWriteTitle(PreCommitTool::TITLE, 'title');
        $this->shouldGetFilesCommitted($files);
        $this->shouldHandleQuery(new ConfigurationDataFinderQuery(), $configurationDataResponse);
        $this->shouldHandleCommand(new ComposerToolCommand($files, $configurationDataResponse->getErrorMessage()));
        $this->shouldHandleCommand(new JsonLintToolCommand($files, $configurationDataResponse->getErrorMessage()));
        $this->shouldHandleCommand(new PhpLintToolCommand($files, $configurationDataResponse->getErrorMessage()));
        $this->shouldHandleCommand(
            new PhpCsToolCommand(
                $files,
                $configurationDataResponse->getPhpCsStandard(),
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT
            )
        );
        $this->shouldHandleCommand(
            new PhpCsFixerToolCommand(
                $files,
                $configurationDataResponse->isPhpCsFixerPsr0(),
                $configurationDataResponse->isPhpCsFixerPsr1(),
                $configurationDataResponse->isPhpCsFixerPsr2(),
                $configurationDataResponse->isPhpCsFixerSymfony(),
                $configurationDataResponse->getErrorMessage()
            )
        );
        $this->shouldHandleCommand(
            new PhpMdToolCommand(
                $files,
                $configurationDataResponse->getErrorMessage()
            )
        );
        $this->shouldHandleCommand(
            new PhpUnitToolCommand(
                $configurationDataResponse->isPhpunitRandomMode(),
                $configurationDataResponse->getPhpunitOptions(),
                $configurationDataResponse->getErrorMessage()
            )
        );

        $this->shouldWriteLnOutput(GoodJobLogoResponse::paint($configurationDataResponse->getRightMessage()));

        $this->preCommitToolCommandHandler->handle(new PreCommitToolCommand());
    }
}
