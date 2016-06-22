<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

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
     * @var PhpMdOptions
     */
    private $options;

    /**
     * PhpMd constructor.
     *
     * @param Undefined    $undefined
     * @param Enabled      $enabled
     * @param PhpMdOptions $options
     */
    public function __construct(Undefined $undefined, Enabled $enabled, PhpMdOptions $options)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->options = $options;
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
            $enabled,
            $this->options
        );
    }

    /**
     * @return PhpMdOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param PhpMdOptions $options
     *
     * @return PhpMd
     */
    public function setOptions(PhpMdOptions $options)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $options
        );
    }
}
