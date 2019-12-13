<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinder;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Git\Contract\Command\PrePushTool;
use PhpGitHooks\Module\Git\Contract\Command\PrePushToolHandler;
use PhpGitHooks\Module\Git\Contract\Exception\InvalidPushException;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverage;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitTool;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverage;

class PrePushToolHandlerTest extends GitUnitTestCase
{
    private $remote = 'origin';
    private $url = 'git@github.com';
    /**
     * @var PrePushToolHandler
     */
    private $prePushToolCommandHandler;

    protected function setUp(): void
    {
        $this->prePushToolCommandHandler = new PrePushToolHandler(
            $this->getQueryBus(),
            $this->getPrePushOriginalExecutor(),
            $this->getOutputInterface(),
            $this->getCommandBus()
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteHook()
    {
        $this->shouldHandleQuery(
            new ConfigurationDataFinder(),
            ConfigurationDataResponseStub::createCustom(false, false, false)
        );

        $this->prePushToolCommandHandler->handle(new PrePushTool($this->remote, $this->url));
    }

    /**
     * @test
     */
    public function itShouldThrowsExceptionFromOriginalScript()
    {
        $this->expectException(InvalidPushException::class);

        $configurationDataResponse = ConfigurationDataResponseStub::createCustom(false, false, true);

        $this->shouldHandleQuery(
            new ConfigurationDataFinder(),
            $configurationDataResponse
        );
        $this->shouldWriteLnOutput(PrePushToolHandler::PRE_PUSH_HOOK);
        $this->shouldExecutePrePushOriginal($this->remote, $this->url, 'error');
        $this->shouldWriteLnOutput(
            BadJobLogoResponse::paint($configurationDataResponse->getPrePush()->getErrorMessage())
        );

        $this->prePushToolCommandHandler->handle(new PrePushTool($this->remote, $this->url));
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $configurationDataResponse = ConfigurationDataResponseStub::createCustom(false, false, true);

        $this->shouldHandleQuery(
            new ConfigurationDataFinder(),
            $configurationDataResponse
        );
        $this->shouldWriteLnOutput(PrePushToolHandler::PRE_PUSH_HOOK);
        $this->shouldExecutePrePushOriginal($this->remote, $this->url, '');
        $this->shouldHandleCommand(
            new PhpUnitTool(
                $configurationDataResponse->getPrePush()->getPhpUnit()->isPhpunitRandomMode(),
                $configurationDataResponse->getPrePush()->getPhpUnit()->getPhpunitOptions(),
                $configurationDataResponse->getPrePush()->getErrorMessage()
            )
        );
        $this->shouldHandleCommand(
            new StrictCoverage(
                $configurationDataResponse->getPrePush()->getPhpUnitStrictCoverage()->getMinimum(),
                $configurationDataResponse->getPrePush()->getErrorMessage()
            )
        );

        $this->shouldHandleCommand(
            new GuardCoverage(
                $configurationDataResponse->getPreCommit()->getPhpUnitGuardCoverage()->getWarningMessage()
            )
        );

        $this->shouldWriteLnOutput(
            GoodJobLogoResponse::paint($configurationDataResponse->getPrePush()->getRightMessage())
        );

        $this->prePushToolCommandHandler->handle(new PrePushTool($this->remote, $this->url));
    }
}
