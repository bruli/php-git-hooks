<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpMd;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpMdStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     *
     * @return PhpMd
     */
    public static function create(Undefined $undefined, Enabled $enabled)
    {
        return new PhpMd($undefined, $enabled);
    }

    /**
     * @return PhpMd
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random());
    }
}
