<?php

namespace Module\Configuration\Tests\Infrastructure;

use Module\Configuration\Infrastructure\Hook\HookCopier;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

trait HookCopierTrait
{
    /**
     * @var HookCopier
     */
    private $hookCopier;

    /**
     * @return \Mockery\MockInterface|HookCopier
     */
    protected function getHookCopier()
    {
        return $this->hookCopier = $this->hookCopier ?: Mock::get(HookCopier::class);
    }

    protected function shouldCopyPreCommitHook()
    {
        $this->getHookCopier()
             ->shouldReceive('copyPreCommitHook')
             ->once();
    }

    protected function shouldCopyCommitMsgHook()
    {
        $this->getHookCopier()
             ->shouldReceive('copyCommitMsgHook')
             ->once();
    }
}
