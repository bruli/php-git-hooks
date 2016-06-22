<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class MinimumStrictCoverageStub implements RandomStubInterface
{
    /**
     * @param float $value
     *
     * @return MinimumStrictCoverage
     */
    public static function create($value)
    {
        return new MinimumStrictCoverage($value);
    }

    /**
     * @return MinimumStrictCoverage
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->randomFloat(2, 0, 100));
    }
}
