<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Application\Config\HookConfigInterface;

/**
 * Class PreCommitExecutor.
 */
abstract class PreCommitExecutor
{
    /** @var HookConfigInterface  */
    protected $preCommitConfig;

    /**
     * @return bool
     */
    protected function isEnabled()
    {
        return $this->preCommitConfig->isEnabled($this->commandName());
    }

    /**
     * @return string
     */
    abstract protected function commandName();
}
