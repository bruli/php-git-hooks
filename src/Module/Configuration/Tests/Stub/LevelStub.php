<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Level;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;
use Module\Tests\Infrastructure\Stub\StubCreator;

class LevelStub implements RandomStubInterface
{
    /**
     * @param bool $value
     *
     * @return Level
     */
    public static function create($value)
    {
        return new Level($value);
    }

    /**
     * @return Level
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->boolean);
    }
}
