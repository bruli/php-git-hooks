<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Class ConfigFileToolValidator.
 */
class ConfigFileToolValidator implements FilesValidatorInterface
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
    public function validate()
    {
        foreach ($this->files as $configFile) {
            if (file_exists($configFile)) {
                return true;
            }
        }

        return false;
    }
}
