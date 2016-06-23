<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\RegularExpression;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class CommitMsgStub implements RandomStubInterface
{
    /**
     * @param Undefined         $undefined
     * @param Enabled           $enabled
     * @param RegularExpression $regularExpression
     *
     * @return CommitMsg
     */
    public static function create(
        Undefined $undefined,
        Enabled $enabled,
        RegularExpression $regularExpression
    ) {
        return new CommitMsg($undefined, $enabled, $regularExpression);
    }

    /**
     * @return CommitMsg
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            RegularExpressionStub::random()
        );
    }

    /**
     * @return CommitMsg
     */
    public static function setUndefined()
    {
        return self::create(
            new Undefined(true),
            new Enabled(false),
            RegularExpressionStub::create(null)
        );
    }

    /**
     * @return CommitMsg
     */
    public static function createEnabled()
    {
        return self::create(
            new Undefined(false),
            new Enabled(true),
            RegularExpressionStub::create('#[0-9]{2,7}')
        );
    }
}
