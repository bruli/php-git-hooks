<?php

namespace PhpGitHooks\Module\PhpUnit\Model;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;

interface StrictCoverageProcessorInterface
{
    /**
     * @param MinimumStrictCoverage $minimumStrictCoverage
     *
     * @return float
     */
    public function process(MinimumStrictCoverage $minimumStrictCoverage);
}
