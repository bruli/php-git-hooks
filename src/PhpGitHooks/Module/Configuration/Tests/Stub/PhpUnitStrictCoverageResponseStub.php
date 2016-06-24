<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitStrictCoverageResponse;

class PhpUnitStrictCoverageResponseStub
{
    const MINIMUM = 99.00;

    /**
     * @param bool  $phpunitStrictCoverage
     * @param float $minimum
     *
     * @return PhpUnitStrictCoverageResponse
     */
    public static function create($phpunitStrictCoverage, $minimum)
    {
        return new PhpUnitStrictCoverageResponse($phpunitStrictCoverage, $minimum);
    }

    /**
     * @return PhpUnitStrictCoverageResponse
     */
    public static function createEnabled()
    {
        return self::create(true, self::MINIMUM);
    }
}
