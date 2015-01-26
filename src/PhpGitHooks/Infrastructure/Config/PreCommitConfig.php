<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class PreCommitConfig
 * @package PhpGitHooks\Infrastructure\Config
 */
class PreCommitConfig
{
    /** @var ConfigFileReader */
    private $configFileReader;

    /**
     * @param ConfigFileReader $configFileReader
     */
    public function __construct(ConfigFileReader $configFileReader)
    {
        $this->configFileReader = $configFileReader;
    }

    /**
     * @param $service
     * @return bool
     */
    public function isEnabled($service)
    {
        $data = $this->getData();

        if (false === isset($data[$service]) || false === is_bool($data[$service])) {
            return false;
        }

        return $data[$service];
    }

    /**
     * @return array
     */
    private function getData()
    {
        $data = $this->configFileReader->getData();

        return $data['pre-commit']['execute'];
    }
}
