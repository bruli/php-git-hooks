<?php

namespace Module\PhpUnit\Tests\Behaviour;

use Module\Configuration\Service\HookQuestions;
use Module\Git\Contract\Response\BadJobLogoResponse;
use Module\Git\Contract\Response\GoodJobLogoResponse;
use Module\Git\Service\PreCommitOutputWriter;
use Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use Module\PhpUnit\Contract\CommandHandler\PhpUnitToolCommandHandler;
use Module\PhpUnit\Contract\Exception\PhpUnitViolationException;
use Module\PhpUnit\Service\PhpUnitToolExecutor;
use Module\PhpUnit\Tests\Infrastructure\PhpUnitUnitTestCase;

class PhpUnitToolCommandHandlerTest extends PhpUnitUnitTestCase
{
    /**
     * @var PhpUnitToolCommandHandler
     */
    private $phpUnitToolCommandHandler;

    protected function setUp()
    {
        $this->phpUnitToolCommandHandler = new PhpUnitToolCommandHandler(
            new PhpUnitToolExecutor(
                $this->getOutputInterface(),
                $this->getPhpUnitProcessor(),
                $this->getPhpUnitProcessor()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpUnitViolationException::class);

        $options = '--testsuite default';
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $outputMessage = new PreCommitOutputWriter(PhpUnitToolExecutor::EXECUTING_MESSAGE);

        $this->shouldWriteLnOutput($outputMessage->getMessage());
        $this->shouldProcessPhpUnit($options, false);
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage));

        $this->phpUnitToolCommandHandler->handle(
            new PhpUnitToolCommand(
                true,
                $options,
                $errorMessage
            )
        );
    }

    /**
     * @test
     */
    public function itShouldExecuteAndWorksFine()
    {
        $options = '--testsuite default';
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $outputMessage = new PreCommitOutputWriter(PhpUnitToolExecutor::EXECUTING_MESSAGE);

        $this->shouldWriteLnOutput($outputMessage->getMessage());
        $this->shouldProcessPhpUnit($options, true);

        $this->phpUnitToolCommandHandler->handle(
            new PhpUnitToolCommand(
                true,
                $options,
                $errorMessage
            )
        );
    }
}
