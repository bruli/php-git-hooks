<?php

namespace PhpGitHooks\Infrastructure\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigFileWriter
 * @package PhpGitHooks\Infrastructure\Config
 */
class ConfigFileWriter
{
    /**
     * @param string $file
     * @param array  $configData
     */
    public function write($file, $configData)
    {
        $data = Yaml::dump($configData);

        file_put_contents($file, $data);
    }
}
