<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\RegularExpression;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

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
}
