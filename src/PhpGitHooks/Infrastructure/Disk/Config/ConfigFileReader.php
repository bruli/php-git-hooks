<?php

namespace PhpGitHooks\Infrastructure\Disk\Config;

use Symfony\Component\Yaml\Yaml;

final class ConfigFileReader implements ConfigFileReaderInterface
{
    const CONFIG_FILE = 'php-git-hooks.yml';

    /**
     * @return array
     */
    public function getFileContents()
    {
        if (true === $this->configFileExists()) {
            return $this->getConfigData();
        }

        return [];
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
