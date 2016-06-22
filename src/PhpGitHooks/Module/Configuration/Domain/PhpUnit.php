<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class PhpUnit implements ToolInterface
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
     * @var PhpUnitRandomMode
     */
    private $randomMode;
    /**
     * @var PhpUnitOptions
     */
    private $options;
    /**
     * @var PhpUnitStrictCoverage
     */
    private $strictCoverage;

    /**
     * PhpUnit constructor.
     *
     * @param Undefined $undefined
     * @param Enabled $enabled
     * @param PhpUnitRandomMode $randomMode
     * @param PhpUnitOptions $options
     * @param PhpUnitStrictCoverage $strictCoverage
     */
    public function __construct(
        Undefined $undefined,
        Enabled $enabled,
        PhpUnitRandomMode $randomMode,
        PhpUnitOptions $options,
        PhpUnitStrictCoverage $strictCoverage
    ) {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->randomMode = $randomMode;
        $this->options = $options;
        $this->strictCoverage = $strictCoverage;
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
     * @return PhpUnitRandomMode
     */
    public function getRandomMode()
    {
        return $this->randomMode;
    }

    /**
     * @return PhpUnitOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Enabled $enabled
     *
     * @return PhpUnit
     */
    public function setEnabled(Enabled $enabled)
    {
        $randomMode = false === $enabled->value() ? new PhpUnitRandomMode(false) : $this->randomMode;
        $options = false === $enabled->value() ? new PhpUnitOptions(null) : $this->options;

        return new self(
            new Undefined(false),
            $enabled,
            $randomMode,
            $options,
            $this->strictCoverage
        );
    }

    /**
     * @param PhpUnitRandomMode $randomMode
     * @param PhpUnitOptions    $options
     *
     * @return PhpUnit
     */
    public function setRandomModeAndOptions(PhpUnitRandomMode $randomMode, PhpUnitOptions $options)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $randomMode,
            $options,
            $this->strictCoverage
        );
    }

    /**
     * @return PhpUnitStrictCoverage
     */
    public function getStrictCoverage()
    {
        return $this->strictCoverage;
    }

    /**
     * @param PhpUnitStrictCoverage $strictCoverage
     * @return PhpUnit
     */
    public function setStrictCoverage(PhpUnitStrictCoverage $strictCoverage)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $this->randomMode,
            $this->options,
            $strictCoverage
        );
    }
}
