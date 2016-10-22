<?php

namespace PhpGitHooks\Module\Configuration\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Composer\IO\IOInterface;

class ConfigurationProcessorCommand implements CommandInterface
{
    /**
     * @var IOInterface
     */
    private $input;

    /**
     * ConfigurationProcessorCommand constructor.
     *
     * @param IOInterface $input
     */
    public function __construct(IOInterface $input)
    {
        $this->input = $input;
    }

    /**
     * @return IOInterface
     */
    public function getInput()
    {
        return $this->input;
    }
}
