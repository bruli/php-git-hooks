<?php

namespace PhpGitHooks\Application\Config;

use PhpGitHooks\Infrastructure\Config\CheckConfigFile;

/**
 * Class ConfigFileValidator
 * @package PhpGitHooks\Application\Config
 */
class ConfigFileValidator
{
    /** @var CheckConfigFile */
    private $checkConfigFile;

    /**
     * @param CheckConfigFile $checkConfigFile
     */
    public function __construct(CheckConfigFile $checkConfigFile)
    {
        $this->checkConfigFile = $checkConfigFile;
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
