<?php

namespace PhpGitHooks\Module\Git\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Query\ConfigurationDataFinderQuery;
use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Git\Contract\Command\PrePushToolCommand;
use PhpGitHooks\Module\Git\Contract\CommandHandler\PrePushToolCommandHandler;
use PhpGitHooks\Module\Git\Contract\Exception\InvalidPushException;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Contract\Response\GoodJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PrePushTool;
use PhpGitHooks\Module\Git\Tests\Infrastructure\GitUnitTestCase;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use PhpGitHooks\Module\PhpUnit\Contract\Command\StrictCoverageCommand;

class PrePushToolCommandHandlerTest extends GitUnitTestCase
{
    private $remote = 'origin';
    private $url = 'git@github.com';
    /**
     * @var PrePushToolCommandHandler
     */
    private $prePushToolCommandHandler;

    protected function setUp()
    {
        $this->prePushToolCommandHandler = new PrePushToolCommandHandler(
            new PrePushTool(
                $this->getQueryBus(),
                $this->getPrePushOriginalExecutor(),
                $this->getOutputInterface(),
                $this->getCommandBus()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteHook()
    {
        $this->shouldHandleQuery(
            new ConfigurationDataFinderQuery(),
            ConfigurationDataResponseStub::createCustom(false, false, false)
        );

        $this->prePushToolCommandHandler->handle(new PrePushToolCommand($this->remote, $this->url));
    }

    /**
     * @test
     */
    public function itShouldThrowsExceptionFromOriginalScript()
    {
        $this->expectException(InvalidPushException::class);

        $configurationDataResponse = ConfigurationDataResponseStub::createCustom(false, false, true);

        $this->shouldHandleQuery(
            new ConfigurationDataFinderQuery(),
            $configurationDataResponse
        );
        $this->shouldWriteLnOutput(PrePushTool::PRE_PUSH_HOOK);
        $this->shouldExecutePrePushOriginal($this->remote, $this->url, 'error');
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint($configurationDataResponse->getPrePushErrorMessage()));

        $this->prePushToolCommandHandler->handle(new PrePushToolCommand($this->remote, $this->url));
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $configurationDataResponse = ConfigurationDataResponseStub::createCustom(false, false, true);

        $this->shouldHandleQuery(
            new ConfigurationDataFinderQuery(),
            $configurationDataResponse
        );
        $this->shouldWriteLnOutput(PrePushTool::PRE_PUSH_HOOK);
        $this->shouldExecutePrePushOriginal($this->remote, $this->url, '');
        $this->shouldHandleCommand(
            new PhpUnitToolCommand(
                $configurationDataResponse->isPrePushPhpUnitRandom(),
                $configurationDataResponse->getPrePushPhpUnitOptions(),
                $configurationDataResponse->getPrePushErrorMessage()
            )
        );
        $this->shouldHandleCommand(
            new StrictCoverageCommand(
                $configurationDataResponse->getPrePushMinimum(),
                $configurationDataResponse->getPrePushErrorMessage()
            )
        );

        $this->shouldWriteLnOutput(GoodJobLogoResponse::paint($configurationDataResponse->getPrePushRightMessage()));

        $this->prePushToolCommandHandler->handle(new PrePushToolCommand($this->remote, $this->url));
    }
}
