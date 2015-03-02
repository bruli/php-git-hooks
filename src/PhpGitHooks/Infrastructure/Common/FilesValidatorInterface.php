<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FilesValidatorInterface.
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
    public function validate();
}
