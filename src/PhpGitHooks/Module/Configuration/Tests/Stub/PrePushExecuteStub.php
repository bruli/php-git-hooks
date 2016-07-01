<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Execute;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitGuardCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;

class PrePushExecuteStub
{
    /**
     * @param PhpUnit               $phpUnit
     * @param PhpUnitStrictCoverage $strictCoverage
     * @param PhpUnitGuardCoverage  $guardCoverage
     *
     * @return Execute
     */
    public static function create(
        PhpUnit $phpUnit,
        PhpUnitStrictCoverage $strictCoverage,
        PhpUnitGuardCoverage $guardCoverage
    ) {
        return new Execute([$phpUnit, $strictCoverage, $guardCoverage]);
    }

    /**
     * @return Execute
     */
    public static function createEnabled()
    {
        return self::create(
            PhpUnitStub::createEnabled(),
            PhpUnitStrictCoverageStub::createEnabled(),
            PhpUnitGuardCoverageStub::createEnabled('fix')
        );
    }
}
