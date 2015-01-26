<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Infrastructure\Config\PreCommitConfig;

/**
 * Class PreCommitExecuter
 * @package PhpGitHooks\Infrastructure\Common
 */
abstract class PreCommitExecuter
{
    /** @var PreCommitConfig  */
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
