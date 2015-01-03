<?php

namespace PhpGitHooks\Infraestructure\Config;

/**
 * Class ConfigFile
 * @package PhpGitHooks\Infraestructure\Config
 */
class ConfigFile
{
    /** @var  ConfigFileValidator */
    private $configFileValidator;
    /** @var ConfigFileReader */
    private $configFileReader;

    /**
     * @param ConfigFileValidator $configFileValidator
     * @param ConfigFileReader    $configFileReader
     */
    public function __construct(ConfigFileValidator $configFileValidator, ConfigFileReader $configFileReader)
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
}
