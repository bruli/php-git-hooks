<?php

namespace Module\Configuration\Infrastructure\Persistence\Disk;

use Module\Configuration\Model\ConfigurationFileWriterInterface;
use Symfony\Component\Yaml\Yaml;

class ConfigurationFileWriter implements ConfigurationFileWriterInterface
{
    /**
     * @param array $data
     */
    public static function write(array $data)
    {
        $yaml = Yaml::dump($data);

        file_put_contents('php-git-hooks.yml', $yaml);
    }
}
