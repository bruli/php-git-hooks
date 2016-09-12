<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverageCommand;
use PhpGitHooks\Module\PhpUnit\Contract\CommandHandler\GuardCoverageToolCommandHandler;
use PhpGitHooks\Module\PhpUnit\Service\GuardCoverageTool;
use PhpGitHooks\Module\PhpUnit\Tests\Infrastructure\PhpUnitUnitTestCase;

class GuardCoverageToolCommandHandlerTest extends PhpUnitUnitTestCase
{
    /**
     * @var GuardCoverageToolCommandHandler
     */
    private $guardCoverageToolCommandHandler;

    protected function setUp()
    {
        $this->guardCoverageToolCommandHandler = new GuardCoverageToolCommandHandler(
            new GuardCoverageTool(
                $this->getOutputInterface(),
                $this->getStrictCoverageProcessor(),
                $this->getGuardCoverageFileReader(),
                $this->getGuardCoverageFileWriter()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldShowWarningMessage()
    {
        $outputMessage = new PreCommitOutputWriter(GuardCoverageTool::CHECKING_MESSAGE);
        $currentCoverage = 60.00;
        $previousCoverage = 70.00;

        $this->shouldProcessStrictCoverage($currentCoverage);
        $this->shouldWriteOutput($outputMessage->getMessage());
        $this->shouldReadGuardCoverage($previousCoverage);
        $this->shouldWriteLnOutput(
            sprintf(
                "\n<bg=yellow;options=bold>%s Previous coverage %s, current coverage %s.</>",
                HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE_DEFAULT,
                $previousCoverage,
                $currentCoverage
            )
        );
        $this->shouldWriteGuardCoverage($currentCoverage);

        $this->guardCoverageToolCommandHandler->handle(
            new GuardCoverageCommand(HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE_DEFAULT)
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $outputMessage = new PreCommitOutputWriter(GuardCoverageTool::CHECKING_MESSAGE);
        $currentCoverage = 70.00;
        $previousCoverage = 60.00;

        $this->shouldProcessStrictCoverage($currentCoverage);
        $this->shouldWriteOutput($outputMessage->getMessage());
        $this->shouldReadGuardCoverage($previousCoverage);
        $this->shouldWriteLnOutput($this->buildStrictCoverageSuccessfulMessage($currentCoverage, $previousCoverage,
            $outputMessage->getSuccessfulMessage()));
        $this->shouldWriteGuardCoverage($currentCoverage);

        $this->guardCoverageToolCommandHandler->handle(
            new GuardCoverageCommand(HookQuestions::PHPUNIT_GUARD_COVERAGE_MESSAGE_DEFAULT)
        );
    }

    private function buildStrictCoverageSuccessfulMessage($currentCoverage, $previousCoverage, $getSuccessfulMessage)
    {
        return $getSuccessfulMessage .
        ' <comment>[' .
        round($currentCoverage, 0) .
        '% >= ' .
        round($previousCoverage, 0) .
        '%]</comment>';
    }
}
