<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Composer;
use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class ComposerStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     *
     * @return Composer
     */
    public static function create(Undefined $undefined, Enabled $enabled)
    {
        return new Composer($undefined, $enabled);
    }

    /**
     * @return Composer
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random());
    }
}
