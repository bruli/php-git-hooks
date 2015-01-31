<?php

namespace PhpGitHooks\Infrastructure\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigFileReader
 * @package PhpGitHooks\Infrastructure\Config
 */
class ConfigFileReader implements FileReaderInterface
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
