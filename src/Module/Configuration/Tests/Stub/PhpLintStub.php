<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpLint;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpLintStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     *
     * @return PhpLint
     */
    public static function create(Undefined $undefined, Enabled $enabled)
    {
        return new PhpLint($undefined, $enabled);
    }

    /**
     * @return PhpLint
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random());
    }
}
