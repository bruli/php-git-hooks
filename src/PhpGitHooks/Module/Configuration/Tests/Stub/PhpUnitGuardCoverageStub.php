<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitGuardCoverage;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpUnitGuardCoverageStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     * @param Message   $warningMessage
     *
     * @return PhpUnitGuardCoverage
     */
    public static function create(Undefined $undefined, Enabled $enabled, Message $warningMessage)
    {
        return new PhpUnitGuardCoverage($undefined, $enabled, $warningMessage);
    }

    /**
     * @return PhpUnitGuardCoverage
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            MessageStub::random()
        );
    }

    /**
     * @param string|null $message
     * @return PhpUnitGuardCoverage
     */
    public static function createEnabled($message = null)
    {
        return self::create(
            new Undefined(false),
            EnabledStub::create(true),
            MessageStub::create($message)
        );
    }

    /**
     * @return PhpUnitGuardCoverage
     */
    public static function setUndefined()
    {
        return self::create(
            new Undefined(true),
            EnabledStub::create(false),
            MessageStub::create(null)
        );
    }
}
