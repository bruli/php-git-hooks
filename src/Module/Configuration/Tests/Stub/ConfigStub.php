<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\Config;
use Module\Configuration\Domain\PreCommit;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class ConfigStub implements RandomStubInterface
{
    /**
     * @param PreCommit $preCommit
     * @param CommitMsg $commitMsg
     *
     * @return Config
     */
    public static function create(PreCommit $preCommit, CommitMsg $commitMsg)
    {
        return new Config($preCommit, $commitMsg);
    }

    /**
     * @return Config
     */
    public static function random()
    {
        return self::create(PreCommitStub::random(), CommitMsgStub::random());
    }
}
