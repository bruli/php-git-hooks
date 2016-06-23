<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Messages;
use PhpGitHooks\Module\Configuration\Domain\PrePush;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Configuration\Model\ExecuteInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PrePushStub implements RandomStubInterface
{
    /**
     * @param Undefined        $undefined
     * @param Enabled          $enabled
     * @param ExecuteInterface $execute
     * @param Messages         $messages
     *
     * @return PrePush
     */
    public static function create(Undefined $undefined, Enabled $enabled, ExecuteInterface $execute, Messages $messages)
    {
        return new PrePush(
            $undefined,
            $enabled,
            $execute,
            $messages
        );
    }

    /**
     * @return PrePush
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            PrePushExecuteStub::create(PhpUnitStub::random()),
            MessagesStub::random()
        );
    }

    /**
     * @return PrePush
     */
    public static function createAllEnabled()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::create(true),
            PrePushExecuteStub::createEnabled(),
            MessagesStub::create(MessageStub::create('0k'), MessageStub::create('Faltal'))
        );
    }

    /**
     * @return PrePush
     */
    public static function setUndefined()
    {
        return self::create(
            new Undefined(true),
            EnabledStub::create(false),
            PrePushExecuteStub::create(PhpUnitStub::setUndefined(), PhpUnitStrictCoverageStub::setUndefined()),
            MessagesStub::random()
        );
    }
}
