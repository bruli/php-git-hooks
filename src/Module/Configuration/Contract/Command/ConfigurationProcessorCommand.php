<?php

namespace Module\Configuration\Contract\Command;

use Composer\IO\IOInterface;

class ConfigurationProcessorCommand
{
    /**
     * @var IOInterface
     */
    private $IOInterface;

    /**
     * ConfigurationProcessorCommand constructor.
     *
     * @param IOInterface $IOInterface
     */
    public function __construct(IOInterface $IOInterface)
    {
        $this->IOInterface = $IOInterface;
    }

    /**
     * @return IOInterface
     */
    public function getIOInterface()
    {
        return $this->IOInterface;
    }
}
