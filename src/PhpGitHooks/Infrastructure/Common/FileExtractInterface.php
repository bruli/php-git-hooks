<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileExtractInterface.
 */
interface FileExtractInterface
{
    /**
     * @param string $file
     *
     * @return string
     */
    public function extract($file);
}
