<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\CommitMsgResponse;

class CommitMsgResponseStub
{
    const REGULAR_EXPRESSION = 'regular_expression';

    /**
     * @param bool   $commitMsg
     * @param string $regularExpression
     *
     * @return CommitMsgResponse
     */
    public static function create($commitMsg, $regularExpression)
    {
        return new CommitMsgResponse($commitMsg, $regularExpression);
    }

    /**
     * @return CommitMsgResponse
     */
    public static function createEnabled()
    {
        return self::create(true, self::REGULAR_EXPRESSION);
    }
}
