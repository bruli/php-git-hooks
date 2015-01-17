<?php

namespace PhpGitHooks\Infraestructure\Config;

/**
 * Class CheckConfigFile
 * @package PhpGitHooks\Infraestructure\Config
 */
class CheckConfigFile
{
    const CONFIG_FILE = 'php-git-hooks.yml';

    /**
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getFile());
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return self::CONFIG_FILE;
    }
}
