<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class ConfigurationDataResponse
{
    /**
     * @var PreCommitResponse
     */
    private $preCommit;
    /**
     * @var CommitMsgResponse
     */
    private $commitMsg;
    /**
     * @var PrePushResponse
     */
    private $prePush;

    /**
     * ConfigurationDataResponse constructor.
     * @param PreCommitResponse $preCommit
     * @param CommitMsgResponse $commitMsg
     * @param PrePushResponse $prePush
     */
    public function __construct(
        PreCommitResponse $preCommit,
        CommitMsgResponse $commitMsg,
        PrePushResponse $prePush
    ) {
        $this->preCommit = $preCommit;
        $this->commitMsg = $commitMsg;
        $this->prePush = $prePush;
    }

    /**
     * @return PreCommitResponse
     */
    public function getPreCommit()
    {
        return $this->preCommit;
    }

    /**
     * @return CommitMsgResponse
     */
    public function getCommitMsg()
    {
        return $this->commitMsg;
    }

    /**
     * @return PrePushResponse
     */
    public function getPrePush()
    {
        return $this->prePush;
    }
}
