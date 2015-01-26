<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class ConfigFileValidator
 * @package PhpGitHooks\Infrastructure\Config
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
