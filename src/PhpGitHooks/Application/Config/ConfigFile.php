<?php

namespace PhpGitHooks\Application\Config;

use PhpGitHooks\Infrastructure\Config\ConfigFileReader;
use PhpGitHooks\Infrastructure\Config\FileReaderInterface;
use PhpGitHooks\Infrastructure\Config\InvalidConfigStructureException;

/**
 * Class ConfigFile
 * @package PhpGitHooks\Application\Config
 */
class ConfigFile
{
    /** @var  ConfigFileValidator */
    private $configFileValidator;
    /** @var ConfigFileReader */
    private $configFileReader;

    /**
     * @param ConfigFileValidator $configFileValidator
     * @param FileReaderInterface $configFileReader
     */
    public function __construct(ConfigFileValidator $configFileValidator, FileReaderInterface $configFileReader)
    {
        $this->configFileValidator = $configFileValidator;
        $this->configFileReader = $configFileReader;
    }

    /**
     * @return array
     */
    private function getConfigurationData()
    {
        return $this->configFileReader->getData();
    }

    /**
     * @return array
     * @throws ConfigFileNotFoundException
     * @throws InvalidConfigStructureException
     */
    public function getPreCommitConfiguration()
    {
        $this->configFileValidator->validate();
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
