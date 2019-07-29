<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitTool;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolHandler;
use PhpGitHooks\Module\PhpUnit\Contract\Exception\PhpUnitViolationException;
use PhpGitHooks\Module\PhpUnit\Tests\Infrastructure\PhpUnitUnitTestCase;

class PhpUnitToolHandlerTest extends PhpUnitUnitTestCase
{
    /**
     * @var PhpUnitToolHandler
     */
    private $phpUnitToolCommandHandler;

    protected function setUp()
    {
        $this->phpUnitToolCommandHandler = new PhpUnitToolHandler(
            $this->getOutputInterface(),
            $this->getPhpUnitProcessor(),
            $this->getPhpUnitProcessor()
        );
    }

    /**
     * @test
     * @throws PhpUnitViolationException
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpUnitViolationException::class);

        $options = '--testsuite default';
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $outputMessage = new PreCommitOutputWriter(PhpUnitToolHandler::EXECUTING_MESSAGE);

        $this->shouldWriteLnOutput($outputMessage->getMessage());
        $this->shouldProcessPhpUnit($options, false);
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($errorMessage, true));

        $this->phpUnitToolCommandHandler->handle(
            new PhpUnitTool(
                true,
                $options,
                $errorMessage,
                true
            )
        );
    }

    /**
     * @test
     * @throws PhpUnitViolationException
     */
    public function itShouldExecuteAndWorksFine()
    {
        $options = '--testsuite default';
        $errorMessage = HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT;
        $outputMessage = new PreCommitOutputWriter(PhpUnitToolHandler::EXECUTING_MESSAGE);

        $this->shouldWriteLnOutput($outputMessage->getMessage());
        $this->shouldProcessPhpUnit($options, true);

        $this->phpUnitToolCommandHandler->handle(
            new PhpUnitTool(
                true,
                $options,
                $errorMessage,
                true
            )
        );
    }
}
