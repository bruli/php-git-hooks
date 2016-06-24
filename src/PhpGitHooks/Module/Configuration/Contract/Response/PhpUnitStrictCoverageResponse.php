<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PhpUnitStrictCoverageResponse
{
    /**
     * @var bool
     */
    private $phpunitStrictCoverage;
    /**
     * @var float
     */
    private $minimum;

    /**
     * PhpUnitStrictCoverageResponse constructor.
     *
     * @param bool  $phpunitStrictCoverage
     * @param float $minimum
     */
    public function __construct($phpunitStrictCoverage, $minimum)
    {
        $this->phpunitStrictCoverage = $phpunitStrictCoverage;
        $this->minimum = $minimum;
    }

    /**
     * @return bool
     */
    public function isPhpunitStrictCoverage()
    {
        return $this->phpunitStrictCoverage;
    }

    /**
     * @return float
     */
    public function getMinimum()
    {
        return $this->minimum;
    }
}
