<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandInterface;

class PhpUnitToolCommand implements CommandInterface
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
     * PhpUnitToolCommand constructor.
     *
     * @param bool        $randomMode
     * @param string|null $options
     * @param string      $errorMessage
     */
    public function __construct($randomMode, $options, $errorMessage)
    {
        $this->randomMode = $randomMode;
        $this->options = $options;
        $this->errorMessage = $errorMessage;
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
}
