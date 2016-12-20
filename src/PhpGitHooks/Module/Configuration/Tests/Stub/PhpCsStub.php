<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Ignore;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsStandard;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpCsStub implements RandomStubInterface
{
    /**
     * @param Undefined     $undefined
     * @param Enabled       $enabled
     * @param PhpCsStandard $standard
     * @param Ignore        $ignore
     *
     * @return PhpCs
     */
    public static function create(Undefined $undefined, Enabled $enabled, PhpCsStandard $standard, Ignore $ignore)
    {
        return new PhpCs($undefined, $enabled, $standard, $ignore);
    }

    /**
     * @return PhpCs
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            PhpCsStandardStub::random(),
            IgnoreStub::random()
        );
    }

    /**
     * @param string $standard
     * @param string $ignore
     *
     * @return PhpCs
     */
    public static function createEnabled($standard = 'PSR2', $ignore = '*/migrations/*')
    {
        return self::create(
            new Undefined(false),
            EnabledStub::create(true),
            PhpCsStandardStub::create($standard),
            IgnoreStub::create($ignore)
        );
    }
}
