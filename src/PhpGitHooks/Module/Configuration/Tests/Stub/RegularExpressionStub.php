<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\RegularExpression;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

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
