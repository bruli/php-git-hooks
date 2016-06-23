<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Model\PrePushOriginalExecutorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait PrePushOriginalExecutorTrait
{
    /**
     * @var PrePushOriginalExecutorInterface
     */
    private $prePushOriginalExecutor;

    /**
     * @return \Mockery\MockInterface|PrePushOriginalExecutorInterface
     */
    protected function getPrePushOriginalExecutor()
    {
        return $this->prePushOriginalExecutor = $this->prePushOriginalExecutor ?: Mock::get(
            PrePushOriginalExecutorInterface::class
        );
    }

    /**
     * @param string      $remote
     * @param string      $url
     * @param string|null $return
     */
    protected function shouldExecutePrePushOriginal($remote, $url, $return)
    {
        $this->getPrePushOriginalExecutor()
            ->shouldReceive('execute')
            ->once()
            ->withArgs([$remote, $url])
            ->andReturn($return);
    }
}
