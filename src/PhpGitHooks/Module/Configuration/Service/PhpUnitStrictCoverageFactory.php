<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpUnitStrictCoverageFactory
{
    /**
     * @param array $data
     *
     * @return PhpUnitStrictCoverage
     */
    public static function fromArray(array $data)
    {
        return new PhpUnitStrictCoverage(
            new Undefined(false),
            new Enabled($data['enabled']),
            new MinimumStrictCoverage($data['minimum'])
        );
    }

    /**
     * @return PhpUnitStrictCoverage
     */
    public static function setUndefined()
    {
        return new PhpUnitStrictCoverage(
            new Undefined(true),
            new Enabled(false),
            new MinimumStrictCoverage(null)
        );
    }
}
