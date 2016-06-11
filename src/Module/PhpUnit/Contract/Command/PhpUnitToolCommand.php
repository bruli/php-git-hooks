<?php

namespace Module\PhpUnit\Contract\Command;

use Infrastructure\CommandBus\CommandInterface;

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
     * PhpUnitToolCommand constructor.
     *
     * @param bool        $randomMode
     * @param string|null $options
     */
    public function __construct($randomMode, $options)
    {
        $this->randomMode = $randomMode;
        $this->options = $options;
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
}
