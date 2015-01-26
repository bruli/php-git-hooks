<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class CheckConfigFile
 * @package PhpGitHooks\Infrastructure\Config
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
