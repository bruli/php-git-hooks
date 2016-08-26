<?php

namespace PhpGitHooks\Module\Configuration\Infrastructure\Persistence\Disk;

use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use PhpGitHooks\Module\Configuration\Service\ConfigFactory;
use Symfony\Component\Yaml\Yaml;

class ConfigurationFileReader implements ConfigurationFileReaderInterface
{
    const CONFIG_FILE = 'php-git-hooks.yml';
    const DEFAULT_CONFIG_FILE = 'php-git-hooks.yml.default';

    /**
     * @return Config
     */
    public function getData()
    {
        $data = true === $this->configFileExists() ? $this->getConfigData() : [];

        $defaultData = $this->getDefaultConfigData();

        $data = array_replace_recursive($defaultData, $data);

        return ConfigFactory::fromArray($data);
    }

    /**
     * @return bool
     */
    private function configFileExists()
    {
        return file_exists(self::CONFIG_FILE);
    }

    /**
     * @return array
     */
    private function getConfigData()
    {
        return Yaml::parse(file_get_contents(self::CONFIG_FILE));
    }

    /**
     * @return array
     */
    private function getDefaultConfigData()
    {
        return Yaml::parse(
            file_get_contents(__DIR__ . '/' . self::DEFAULT_CONFIG_FILE)
        );
    }
}
