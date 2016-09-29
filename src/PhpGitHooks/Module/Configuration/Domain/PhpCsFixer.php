<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

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
     * @var PhpCsFixerOptions
     */
    private $options;

    /**
     * PhpCsFixer constructor.
     *
     * @param Undefined         $undefined
     * @param Enabled           $enabled
     * @param PhpCsFixerLevels  $levels
     * @param PhpCsFixerOptions $options
     */
    public function __construct(
        Undefined $undefined,
        Enabled $enabled,
        PhpCsFixerLevels $levels,
        PhpCsFixerOptions $options
    ) {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->levels = $levels;
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
            $levels,
            $this->options
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
            $levels,
            $this->options
        );
    }

    /**
     * @return PhpCsFixerOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param PhpCsFixerOptions $options
     *
     * @return PhpCsFixer
     */
    public function setOptions(PhpCsFixerOptions $options)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $this->levels,
            $options
        );
    }
}
