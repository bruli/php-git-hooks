<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FilesValidatorInterface
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FilesValidatorInterface
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
