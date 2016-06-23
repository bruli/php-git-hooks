<?php

namespace PhpGitHooks\Module\Configuration\Contract\Command;

use Composer\IO\IOInterface;
use CommandBus\CommandBus\CommandInterface;

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
