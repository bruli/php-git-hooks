<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsStandard;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpCsStub implements RandomStubInterface
{
    /**
     * @param Undefined     $undefined
     * @param Enabled       $enabled
     * @param PhpCsStandard $standard
     *
     * @return PhpCs
     */
    public static function create(Undefined $undefined, Enabled $enabled, PhpCsStandard $standard)
    {
        return new PhpCs($undefined, $enabled, $standard);
    }

    /**
     * @return PhpCs
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random(), PhpCsStandardStub::random());
    }
}
