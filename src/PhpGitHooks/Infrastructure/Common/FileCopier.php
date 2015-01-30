<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileCopier
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FileCopier
{
    /**
     * @param string $file
     */
    public function copy($file);
}
