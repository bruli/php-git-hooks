<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigArrayDataStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\MinimumStrictCoverageStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageCommand;
use PhpGitHooks\Module\PhpUnit\Contract\CommandHandler\StrictCoverageToolCommandHandler;
use PhpGitHooks\Module\PhpUnit\Contract\Exception\InvalidStrictCoverageException;
use PhpGitHooks\Module\PhpUnit\Service\StrictCoverageTool;
use PhpGitHooks\Module\PhpUnit\Service\StrictCoverageToolExecutor;
use PhpGitHooks\Module\PhpUnit\Tests\Infrastructure\PhpUnitUnitTestCase;

class StrictCoverageToolCommandHandlerTest extends PhpUnitUnitTestCase
{
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var StrictCoverageToolCommandHandler
     */
    private $strictCoverageToolCommandHandler;

    protected function setUp()
    {
        $this->errorMessage = ConfigArrayDataStub::ERROR_MESSAGE;
        $this->strictCoverageToolCommandHandler = new StrictCoverageToolCommandHandler(
            new StrictCoverageToolExecutor(
                $this->getOutputInterface(),
                new StrictCoverageTool(
                    $this->getStrictCoverageProcessor(),
                    $this->getOutputInterface()
                )
            )
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(InvalidStrictCoverageException::class);

        $minimumStrictCoverage = MinimumStrictCoverageStub::create(90.00);
        $outputMessage = new PreCommitOutputWriter(StrictCoverageToolExecutor::EXECUTE_MESSAGE);

        $this->shouldWriteOutput($outputMessage->getMessage());
        $this->shouldProcessStrictCoverage(0.00);
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($this->errorMessage));

        $command = new StrictCoverageCommand($minimumStrictCoverage->value(), $this->errorMessage);
        $this->strictCoverageToolCommandHandler->handle($command);
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $minimumStrictCoverage = MinimumStrictCoverageStub::create(90.00);
        $outputMessage = new PreCommitOutputWriter(StrictCoverageToolExecutor::EXECUTE_MESSAGE);

        $this->shouldWriteOutput($outputMessage->getMessage());
        $this->shouldProcessStrictCoverage(91.00);
        $this->shouldWriteLnOutput($outputMessage->getSuccessfulMessage());

        $command = new StrictCoverageCommand($minimumStrictCoverage->value(), $this->errorMessage);
        $this->strictCoverageToolCommandHandler->handle($command);
    }
}
