<?php

namespace PhpGitHooks\Module\Configuration\Infrastructure\Persistence\Disk;

use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use Symfony\Component\Yaml\Yaml;

class ConfigurationFileReader implements ConfigurationFileReaderInterface
{
    const CONFIG_FILE = 'php-git-hooks.yml';

    /**
     * @return array
     */
    public function getData()
    {
        return true === $this->configFileExists() ? $this->getConfigData() : [];
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
