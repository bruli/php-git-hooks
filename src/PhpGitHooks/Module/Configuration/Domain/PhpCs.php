<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class PhpCs implements ToolInterface
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
     * @var PhpCsStandard
     */
    private $standard;

    /**
     * PhpCs constructor.
     *
     * @param Undefined     $undefined
     * @param Enabled       $enabled
     * @param PhpCsStandard $standard
     */
    public function __construct(Undefined $undefined, Enabled $enabled, PhpCsStandard $standard)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->standard = $standard;
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
     * @return PhpCsStandard
     */
    public function getStandard()
    {
        return $this->standard;
    }

    /**
     * @return ToolInterface
     */
    public function setEnabled(Enabled $enabled)
    {
        return new self(
            new Undefined(false),
            $enabled,
            new PhpCsStandard(null)
        );
    }

    /**
     * @param PhpCsStandard $standard
     *
     * @return PhpCs
     */
    public function addStandard(PhpCsStandard $standard)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $standard
        );
    }
}
