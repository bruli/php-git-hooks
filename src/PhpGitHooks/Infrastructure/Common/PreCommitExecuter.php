<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Application\Config\HookConfigInterface;

/**
 * Class PreCommitExecuter
 * @package PhpGitHooks\Infrastructure\Common
 */
abstract class PreCommitExecuter
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
