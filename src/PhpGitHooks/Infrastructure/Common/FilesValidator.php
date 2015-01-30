<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FilesValidator
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FilesValidator
{
    /**
     * @param array $files
     */
    public function setFiles(array $files);

    /**
     * @return bool
     */
    public function existsFile();
}
