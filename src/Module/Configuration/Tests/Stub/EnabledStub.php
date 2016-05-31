<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Enabled;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;
use Module\Tests\Infrastructure\Stub\StubCreator;

class EnabledStub implements RandomStubInterface
{
    /**
     * @param bool $value
     *
     * @return Enabled
     */
    public static function create($value)
    {
        return new Enabled($value);
    }

    /**
     * @return Enabled
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->boolean);
    }
}
