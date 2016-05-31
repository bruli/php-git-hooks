<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\RegularExpression;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;
use Module\Tests\Infrastructure\Stub\StubCreator;

class RegularExpressionStub implements RandomStubInterface
{
    /**
     * @param string|null $value
     *
     * @return RegularExpression
     */
    public static function create($value)
    {
        return new RegularExpression($value);
    }

    /**
     * @return RegularExpression
     */
    public static function random()
    {
        $expression = [null, StubCreator::faker()->word];

        return self::create($expression[array_rand($expression)]);
    }
}
