<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class PhpUnitTool implements CommandInterface
{
    /**
     * @var bool
     */
    private $randomMode;
    /**
     * @var null|string
     */
    private $options;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var bool
     */
    private $enableFaces;

    /**
     * PhpUnitToolCommand constructor.
     *
     * @param bool $randomMode
     * @param string|null $options
     * @param string $errorMessage
     * @param bool $enableFaces
     */
    public function __construct($randomMode, $options, $errorMessage, $enableFaces)
    {
        $this->randomMode = $randomMode;
        $this->options = $options;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
    }

    /**
     * @return bool
     */
    public function isRandomMode()
    {
        return $this->randomMode;
    }

    /**
     * @return null|string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    public function isEnableFaces()
    {
        return $this->enableFaces;
    }
}
