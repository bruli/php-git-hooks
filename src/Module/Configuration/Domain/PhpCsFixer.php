<?php

namespace Module\Configuration\Domain;

use Module\Configuration\Model\ToolInterface;

class PhpCsFixer implements ToolInterface
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
     * @var PhpCsFixerLevels
     */
    private $levels;

    /**
     * PhpCsFixer constructor.
     *
     * @param Undefined        $undefined
     * @param Enabled          $enabled
     * @param PhpCsFixerLevels $levels
     */
    public function __construct(Undefined $undefined, Enabled $enabled, PhpCsFixerLevels $levels)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->levels = $levels;
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
     * @return PhpCsFixerLevels
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * @param Enabled $enabled
     *
     * @return PhpCsFixer
     */
    public function setEnabled(Enabled $enabled)
    {
        $levels = false === $enabled->value() ?
            new PhpCsFixerLevels(
                new Level(false),
                new Level(false),
                new Level(false),
                new Level(false)
            ) : $this->levels;

        return new self(
            new Undefined(false),
            $enabled,
            $levels
        );
    }

    /**
     * @param PhpCsFixerLevels $levels
     *
     * @return PhpCsFixer
     */
    public function addLevels(PhpCsFixerLevels $levels)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $levels
        );
    }
}
