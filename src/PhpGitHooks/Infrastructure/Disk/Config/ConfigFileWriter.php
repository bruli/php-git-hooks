<?php

namespace PhpGitHooks\Infrastructure\Disk\Config;

use Symfony\Component\Yaml\Yaml;

final class ConfigFileWriter implements ConfigFileWriterInterface
{
    /**
     * @param array $configData
     */
    public function write(array $configData)
    {
        $data = Yaml::dump($configData);

        file_put_contents(ConfigFileReader::CONFIG_FILE, $data);
    }
}
