<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class PhpUnitStrictCoverage implements ToolInterface
{
    /**
     * @var Undefined
     */
    private $undefined;
    /**
     * @var Enabled
     */
    private $enabled;
    /**
     * @var MinimumStrictCoverage
     */
    private $minimumStrictCoverage;

    /**
     * PhpUnitStrictCoverage constructor.
     *
     * @param Undefined             $undefined
     * @param Enabled               $enabled
     * @param MinimumStrictCoverage $minimumStrictCoverage
     */
    public function __construct(Undefined $undefined, Enabled $enabled, MinimumStrictCoverage $minimumStrictCoverage)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->minimumStrictCoverage = $minimumStrictCoverage;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled->value();
    }

    /**
     * @return bool
     */
    public function isUndefined()
    {
        return $this->undefined->value();
    }

    /**
     * @return MinimumStrictCoverage
     */
    public function getMinimumStrictCoverage()
    {
        return $this->minimumStrictCoverage;
    }
}
