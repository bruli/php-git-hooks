<?php

namespace PhpGitHooks\Infraestructure\Config;

/**
 * Class ConfigFileValidator
 * @package PhpGitHooks\Infraestructure\Config
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
