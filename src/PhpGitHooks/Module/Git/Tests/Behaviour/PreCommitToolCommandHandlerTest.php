<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Composer\Contract\Command\ComposerTool;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinder;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Tests\Stub\PhpFilesResponseStub;
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
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverageCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageCommand;
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
        $this->shouldHandleQuery(new ConfigurationDataFinder(), $configurationDataResponse);
        $this->shouldHandleCommand(
            new ComposerTool($files, $configurationDataResponse->getPreCommit()->getErrorMessage())
        );
        $this->shouldHandleCommand(
            new JsonLintToolCommand($files, $configurationDataResponse->getPreCommit()->getErrorMessage())
        );
        $this->shouldHandleQuery(
            new PhpFilesExtractorQuery($files),
            PhpFilesResponseStub::create(FilesCommittedStub::createWithoutPhpFiles())
        );
        $this->shouldHandleCommand(
            new PhpLintToolCommand($files, $configurationDataResponse->getPreCommit()->getErrorMessage())
        );
        $this->shouldHandleCommand(
            new PhpCsToolCommand(
                $files,
                $configurationDataResponse->getPreCommit()->getPhpCs()->getPhpCsStandard(),
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT,
                $configurationDataResponse->getPreCommit()->getPhpCs()->getIgnore()
            )
        );
        $this->shouldHandleCommand(
            new PhpCsFixerToolCommand(
                $files,
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr0(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr1(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr2(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerSymfony(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->getPhpCsFixerOptions(),
                $configurationDataResponse->getPreCommit()->getErrorMessage()
            )
        );
        $this->shouldHandleCommand(
            new PhpMdToolCommand(
                $files,
                $configurationDataResponse->getPreCommit()->getPhpMd()->getPhpMdOptions(),
                $configurationDataResponse->getPreCommit()->getErrorMessage()
            )
        );
        $this->shouldHandleCommand(
            new PhpUnitToolCommand(
                $configurationDataResponse->getPreCommit()->getPhpUnit()->isPhpunitRandomMode(),
                $configurationDataResponse->getPreCommit()->getPhpUnit()->getPhpunitOptions(),
                $configurationDataResponse->getPreCommit()->getErrorMessage()
            )
        );

        $this->shouldHandleCommand(
            new StrictCoverageCommand(
                $configurationDataResponse->getPreCommit()->getPhpUnitStrictCoverage()->getMinimum(),
                $configurationDataResponse->getPreCommit()->getErrorMessage()
            )
        );

        $this->shouldHandleCommand(
            new GuardCoverageCommand(
                $configurationDataResponse->getPreCommit()->getPhpUnitGuardCoverage()->getWarningMessage()
            )
        );

        $this->shouldWriteLnOutput(
            GoodJobLogoResponse::paint($configurationDataResponse->getPreCommit()->getRightMessage())
        );

        $this->preCommitToolCommandHandler->handle(new PreCommitToolCommand());
    }
}
