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
     * @return array
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
     * @return array
     *
     * @throws InvalidConfigStructureException
     */
    public function getMessageCommitConfiguration()
    {
        $data = $this->getConfigurationData();

        if (!isset($data['commit-msg']) || !isset($data['commit-msg']['enabled'])) {
            throw new InvalidConfigStructureException();
        }

        if (true === $data['commit-msg']['enabled']) {
            if (!isset($data['commit-msg']['regular-expression'])) {
                throw new InvalidConfigStructureException();
            }
        }

        return $data['commit-msg'];
    }
}
