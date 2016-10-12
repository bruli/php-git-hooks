<?php

namespace PhpGitHooks\Module\Configuration\Infrastructure\Persistence\Disk;

use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use PhpGitHooks\Module\Configuration\Service\ConfigFactory;
use Symfony\Component\Yaml\Yaml;

class ConfigurationFileReader implements ConfigurationFileReaderInterface
{
    const CONFIG_FILE = 'php-git-hooks.yml';

    /**
     * @return Config
     */
    public function getData()
    {
        $data = true === $this->configFileExists() ? $this->getConfigData() : [];

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
}
