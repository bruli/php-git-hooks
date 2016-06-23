<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class Composer implements ToolInterface
{
    /**
     * @var Enabled
     */
    private $enabled;
    /**
     * @var Undefined
     */
    private $undefined;

    /**
     * Composer constructor.
     *
     * @param Undefined $undefined
     * @param Enabled   $enabled
     */
    public function __construct(Undefined $undefined, Enabled $enabled)
    {
        $this->enabled = $enabled;
        $this->undefined = $undefined;
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
     * @return Composer
     */
    public function setEnabled(Enabled $enabled)
    {
        return new self(
            new Undefined(false),
            $enabled
        );
    }
}
