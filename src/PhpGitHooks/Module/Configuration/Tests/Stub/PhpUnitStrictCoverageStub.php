<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpUnitStrictCoverageStub implements RandomStubInterface
{
    /**
     * @param Undefined             $undefined
     * @param Enabled               $enabled
     * @param MinimumStrictCoverage $minimumStrictCoverage
     *
     * @return PhpUnitStrictCoverage
     */
    public static function create(Undefined $undefined, Enabled $enabled, MinimumStrictCoverage $minimumStrictCoverage)
    {
        return new PhpUnitStrictCoverage($undefined, $enabled, $minimumStrictCoverage);
    }

    /**
     * @return PhpUnitStrictCoverage
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            MinimumStrictCoverageStub::random()
        );
    }

    /**
     * @param float $minimum
     *
     * @return PhpUnitStrictCoverage
     */
    public static function createEnabled($minimum = 99.00)
    {
        return self::create(
            new Undefined(false),
            EnabledStub::create(true),
            MinimumStrictCoverageStub::create($minimum)
        );
    }

    /**
     * @return PhpUnitStrictCoverage
     */
    public static function setUndefined()
    {
        return self::create(
            new Undefined(true),
            EnabledStub::create(false),
            MinimumStrictCoverageStub::create(null)
        );
    }
}
