<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Domain\PrePush;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class ConfigStub implements RandomStubInterface
{
    /**
     * @param PreCommit $preCommit
     * @param CommitMsg $commitMsg
     * @param PrePush $prePush
     *
     * @return Config
     */
    public static function create(PreCommit $preCommit, CommitMsg $commitMsg, PrePush $prePush)
    {
        return new Config($preCommit, $commitMsg, $prePush);
    }

    /**
     * @return Config
     */
    public static function random()
    {
        return self::create(PreCommitStub::random(), CommitMsgStub::random(), PrePushStub::random());
    }

    /**
     * @return Config
     */
    public static function createUndefined()
    {
        return self::create(
            PreCommitStub::createUndefined(),
            CommitMsgStub::setUndefined(),
            PrePushStub::setUndefined()
        );
    }

    /**
     * @return Config
     */
    public static function createEnabled()
    {
        return self::create(
            PreCommitStub::createAllEnabled(),
            CommitMsgStub::createEnabled(),
            PrePushStub::createAllEnabled()
        );
    }
}
