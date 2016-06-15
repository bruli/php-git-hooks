<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\RegularExpression;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class CommitMsgFactory
{
    /**
     * @param array $data
     *
     * @return CommitMsg
     */
    public static function fromArray(array $data)
    {
        return  new CommitMsg(
            new Undefined(false),
            new Enabled($data['enabled']),
            new RegularExpression($data['regular-expression'])
        );
    }

    /**
     * @return CommitMsg
     */
    public static function setUndefined()
    {
        return new CommitMsg(
            new Undefined(true),
            new Enabled(false),
            new RegularExpression(null)
        );
    }
}
