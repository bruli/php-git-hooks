<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class PhpLint implements ToolInterface
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
     * PhpLint constructor.
     *
     * @param Undefined $undefined
     * @param Enabled   $enabled
     */
    public function __construct(Undefined $undefined, Enabled $enabled)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
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
     * @param Enabled $enabled
     *
     * @return PhpLint
     */
    public function setEnabled(Enabled $enabled)
    {
        return new self(
            new Undefined(false),
            $enabled
        );
    }
}
