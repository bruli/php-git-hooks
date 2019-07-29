<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigArrayDataStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\MinimumStrictCoverageStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverage;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageToolHandler;
use PhpGitHooks\Module\PhpUnit\Contract\Exception\InvalidStrictCoverageException;
use PhpGitHooks\Module\PhpUnit\Service\StrictCoverageTool;
use PhpGitHooks\Module\PhpUnit\Tests\Infrastructure\PhpUnitUnitTestCase;

class StrictCoverageToolHandlerTest extends PhpUnitUnitTestCase
{
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var StrictCoverageToolHandler
     */
    private $strictCoverageToolCommandHandler;

    protected function setUp()
    {
        $this->errorMessage = ConfigArrayDataStub::ERROR_MESSAGE;
        $this->strictCoverageToolCommandHandler = new StrictCoverageToolHandler(
            $this->getOutputInterface(),
            new StrictCoverageTool(
                $this->getStrictCoverageProcessor(),
                $this->getOutputInterface()
            )
        );
    }

    /**
     * @test
     * @throws InvalidStrictCoverageException
     */
    public function itShouldThrowsException()
    {
        $this->expectException(InvalidStrictCoverageException::class);

        $minimumStrictCoverage = MinimumStrictCoverageStub::create(90.00);
        $outputMessage = new PreCommitOutputWriter(StrictCoverageToolHandler::EXECUTE_MESSAGE);

        $this->shouldWriteOutput($outputMessage->getMessage());
        $this->shouldProcessStrictCoverage(0.00);
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage, true));

        $command = new StrictCoverage($minimumStrictCoverage->value(), $this->errorMessage, true);
        $this->strictCoverageToolCommandHandler->handle($command);
    }

    /**
     * @test
     * @throws InvalidStrictCoverageException
     */
    public function itShouldWorksFine()
    {
        $minimumStrictCoverage = MinimumStrictCoverageStub::create(90.00);
        $outputMessage = new PreCommitOutputWriter(StrictCoverageToolHandler::EXECUTE_MESSAGE);

        $coverage = 91.00;

        $this->shouldWriteOutput($outputMessage->getMessage());
        $this->shouldProcessStrictCoverage($coverage);
        $this->shouldWriteLnOutput(
            $this->buildStrictCoverageSuccessfulMessage(
                $coverage,
                $outputMessage->getSuccessfulMessage()
            )
        );

        $command = new StrictCoverage($minimumStrictCoverage->value(), $this->errorMessage, true);
        $this->strictCoverageToolCommandHandler->handle($command);
    }

    private function buildStrictCoverageSuccessfulMessage($coverage, $getSuccessfulMessage)
    {
        return $getSuccessfulMessage . ' <comment>[' . round($coverage, 0) . '%]</comment>';
    }
}
