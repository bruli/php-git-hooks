<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use PhpGitHooks\Module\Configuration\Infrastructure\Hook\HookCopier;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

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
    
    protected function shouldCopyPrePushHook()
    {
        $this->getHookCopier()
             ->shouldReceive('copyPrePushHook')
             ->once();
    }
}
