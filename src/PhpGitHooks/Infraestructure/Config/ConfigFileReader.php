<?php

namespace PhpGitHooks\Infraestructure\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigFileReader
 * @package PhpGitHooks\Infraestructure\Config
 */
class ConfigFileReader
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
     * @return array
     */
    public function getData()
    {
        $yaml = new Yaml();

        return $yaml->parse(file_get_contents($this->checkConfigFile->getFile()));
    }
}
