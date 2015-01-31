<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileExtractInterface
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FileExtractInterface
{
    /**
     * @param  string $file
     * @return string
     */
    public function extract($file);
}
