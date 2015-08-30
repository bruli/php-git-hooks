<?php

namespace PhpGitHooks\Application\Config;

use PhpGitHooks\Infrastructure\Common\CheckFileInterface;
use PhpGitHooks\Infrastructure\Config\CheckConfigFile;

/**
 * Class ConfigFileValidator.
 */
class ConfigFileValidator
{
    /** @var CheckConfigFile */
    private $checkConfigFile;

    /**
     * @param CheckFileInterface $checkFileInterface
     */
    public function __construct(CheckFileInterface $checkFileInterface)
    {
        $this->checkConfigFile = $checkFileInterface;
    }

    /**
     * @throws ConfigFileNotFoundException
     */
    public function validate()
    {
        if (false === $this->checkConfigFile->exists()) {
            throw new ConfigFileNotFoundException();
        }
    }
}
