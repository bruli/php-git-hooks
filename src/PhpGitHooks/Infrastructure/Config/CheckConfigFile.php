<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\CheckFileInterface;

/**
 * Class CheckConfigFile.
 */
class CheckConfigFile implements CheckFileInterface
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
