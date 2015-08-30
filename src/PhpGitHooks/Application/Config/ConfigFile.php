<?php

namespace PhpGitHooks\Application\Config;

use PhpGitHooks\Infrastructure\Config\InvalidConfigStructureException;
use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileReaderInterface;

/**
 * Class ConfigFile.
 */
class ConfigFile
{
    /** @var ConfigFileReaderInterface */
    private $configFileReader;

    /**
     * @param ConfigFileReaderInterface $configFileReaderInterface
     */
    public function __construct(ConfigFileReaderInterface $configFileReaderInterface)
    {
        $this->configFileReader = $configFileReaderInterface;
    }

    /**
     * @return array
     */
    private function getConfigurationData()
    {
        return $this->configFileReader->getFileContents();
    }

    /**
     * @return mixed
     *
     * @throws InvalidConfigStructureException
     */
    public function getPreCommitConfiguration()
    {
        $data = $this->getConfigurationData();

        if (!isset($data['pre-commit']) || !isset($data['pre-commit']['execute'])) {
            throw new InvalidConfigStructureException();
        }

        return $data['pre-commit']['execute'];
    }

    /**
     * @return string
     */
    public function getMessageCommitConfiguration()
    {
        $data = $this->getConfigurationData();

        return $data['commit-msg'];
    }
}
