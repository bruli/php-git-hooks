<?php

namespace Module\Configuration\Domain;

use Module\Configuration\Model\ToolInterface;

class PhpMd implements ToolInterface
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
     * PhpMd constructor.
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
     * @return PhpMd
     */
    public function setEnabled(Enabled $enabled)
    {
        return new self(
            new Undefined(false),
            $enabled
        );
    }
}
