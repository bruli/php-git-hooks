<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\FileWriter;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigFileWriter
 * @package PhpGitHooks\Infrastructure\Config
 */
class ConfigFileWriter implements FileWriter
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
