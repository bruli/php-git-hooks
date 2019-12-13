<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Composer\Contract\Command\ComposerTool;
use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinder;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractor;
use PhpGitHooks\Module\Files\Tests\Stub\PhpFilesResponseStub;
use PhpGitHooks\Module\Git\Contract\Command\PreCommitTool;
use PhpGitHooks\Module\Git\Contract\Command\PreCommitToolHandler;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\JsonLint\Contract\Command\JsonLintTool;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsTool;
use PhpGitHooks\Module\PhpCsFixer\Contract\Command\PhpCsFixerTool;
use PhpGitHooks\Module\PhpLint\Contract\Command\PhpLintTool;
use PhpGitHooks\Module\PhpMd\Contract\Command\PhpMdTool;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverage;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitTool;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverage;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class PreCommitToolHandlerTest extends GitUnitTestCase
{
    /**
     * @var PreCommitToolHandler
     */
    private $preCommitToolCommandHandler;

    protected function setUp(): void
    {
        $this->preCommitToolCommandHandler = new PreCommitToolHandler(
            $this->getOutputInterface(),
            $this->getFilesCommittedExtractor(),
            $this->getQueryBus(),
            $this->getCommandBus(),
            $this->getToolTitleOutputWriter()
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTools()
    {
        $this->shouldWriteTitle(PreCommitToolHandler::TITLE, 'title');
        $this->shouldGetFilesCommitted([StubCreator::faker()->sha1]);
        $this->shouldWriteLnOutput(PreCommitToolHandler::NO_FILES_CHANGED_MESSAGE);

        $this->preCommitToolCommandHandler->handle(new PreCommitTool());
    }

    /**
     * @test
     */
    public function itShouldExecuteAllTools()
    {
        $files = FilesCommittedStub::createAllFiles();
        $configurationDataResponse = ConfigurationDataResponseStub::createAllEnabled();

        $this->shouldWriteTitle(PreCommitToolHandler::TITLE, 'title');
        $this->shouldGetFilesCommitted($files);
        $this->shouldHandleQuery(new ConfigurationDataFinder(), $configurationDataResponse);
        $this->shouldHandleCommand(
            new ComposerTool(
                $files,
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );
        $this->shouldHandleCommand(
            new JsonLintTool(
                $files,
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );
        $this->shouldHandleQuery(
            new PhpFilesExtractor($files),
            PhpFilesResponseStub::create(FilesCommittedStub::createWithoutPhpFiles())
        );
        $this->shouldHandleCommand(
            new PhpLintTool(
                $files,
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );
        $this->shouldHandleCommand(
            new PhpCsTool(
                $files,
                $configurationDataResponse->getPreCommit()->getPhpCs()->getPhpCsStandard(),
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT,
                $configurationDataResponse->getPreCommit()->isEnableFaces(),
                $configurationDataResponse->getPreCommit()->getPhpCs()->getIgnore()
            )
        );
        $this->shouldHandleCommand(
            new PhpCsFixerTool(
                $files,
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr0(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr1(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr2(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->isPhpCsFixerSymfony(),
                $configurationDataResponse->getPreCommit()->getPhpCsFixer()->getPhpCsFixerOptions(),
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );
        $this->shouldHandleCommand(
            new PhpMdTool(
                $files,
                $configurationDataResponse->getPreCommit()->getPhpMd()->getPhpMdOptions(),
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );
        $this->shouldHandleCommand(
            new PhpUnitTool(
                $configurationDataResponse->getPreCommit()->getPhpUnit()->isPhpunitRandomMode(),
                $configurationDataResponse->getPreCommit()->getPhpUnit()->getPhpunitOptions(),
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );

        $this->shouldHandleCommand(
            new StrictCoverage(
                $configurationDataResponse->getPreCommit()->getPhpUnitStrictCoverage()->getMinimum(),
                $configurationDataResponse->getPreCommit()->getErrorMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );

        $this->shouldHandleCommand(
            new GuardCoverage(
                $configurationDataResponse->getPreCommit()->getPhpUnitGuardCoverage()->getWarningMessage()
            )
        );

        $this->shouldWriteLnOutput(
            GoodJobLogoResponse::paint(
                $configurationDataResponse->getPreCommit()->getRightMessage(),
                $configurationDataResponse->getPreCommit()->isEnableFaces()
            )
        );

        $this->preCommitToolCommandHandler->handle(new PreCommitTool());
    }
}
