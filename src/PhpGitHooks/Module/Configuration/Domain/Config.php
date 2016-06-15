<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\HookInterface;
use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class Config
{
    /**
     * @var HookInterface
     */
    private $preCommit;
    /**
     * @var ToolInterface
     */
    private $commitMsg;

    /**
     * Config constructor.
     *
     * @param HookInterface $preCommit
     * @param ToolInterface $commitMsg
     */
    public function __construct(HookInterface $preCommit, ToolInterface $commitMsg)
    {
        $this->preCommit = $preCommit;
        $this->commitMsg = $commitMsg;
    }

    /**
     * @return HookInterface
     */
    public function getPreCommit()
    {
        return $this->preCommit;
    }

    /**
     * @return ToolInterface
     */
    public function getCommitMsg()
    {
        return $this->commitMsg;
    }
}
