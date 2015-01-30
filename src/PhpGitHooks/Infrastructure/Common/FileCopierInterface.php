<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileCopierInterface
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FileCopierInterface
{
    /**
     * @param string $file
     */
    public function copy($file);
}
