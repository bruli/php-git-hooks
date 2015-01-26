<?php

namespace PhpGitHooks\Infraestructure\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigFileWriter
 * @package PhpGitHooks\Infraestructure\Config
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
