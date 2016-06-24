<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class CommitMsgResponse
{
    /**
     * @var bool
     */
    private $commitMsg;
    /**
     * @var string
     */
    private $regularExpression;

    /**
     * CommitMsgResponse constructor.
     *
     * @param bool   $commitMsg
     * @param string $regularExpression
     */
    public function __construct($commitMsg, $regularExpression)
    {
        $this->commitMsg = $commitMsg;
        $this->regularExpression = $regularExpression;
    }

    /**
     * @return bool
     */
    public function isCommitMsg()
    {
        return $this->commitMsg;
    }

    /**
     * @return string
     */
    public function getRegularExpression()
    {
        return $this->regularExpression;
    }
}
