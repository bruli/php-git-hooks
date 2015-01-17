<?php

namespace PhpGitHooks\Infraestructure\Common;

/**
 * Class ConfigFileToolValidator
 * @package PhpGitHooks\Infraestructure\Common
 */
class ConfigFileToolValidator
{
    /** @var array */
    private $files = array();

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
    }

    /**
     * @return bool
     */
    public function existsConfigFile()
    {
        foreach ($this->files as $configFile) {
            if (file_exists($configFile)) {
                return true;
            }
        }

        return false;
    }
}
