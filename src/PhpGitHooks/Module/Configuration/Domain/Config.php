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
     * @var HookInterface
     */
    private $prePush;

    /**
     * Config constructor.
     *
     * @param HookInterface $preCommit
     * @param ToolInterface $commitMsg
     * @param HookInterface $prePush
     */
    public function __construct(HookInterface $preCommit, ToolInterface $commitMsg, HookInterface $prePush)
    {
        $this->preCommit = $preCommit;
        $this->commitMsg = $commitMsg;
        $this->prePush = $prePush;
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

    /**
     * @return HookInterface
     */
    public function getPrePush()
    {
        return $this->prePush;
    }
}
