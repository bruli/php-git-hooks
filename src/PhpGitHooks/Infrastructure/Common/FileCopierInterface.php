<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileCopierInterface.
 */
interface FileCopierInterface
{
    /**
     * @param string $file
     */
    public function copy($file);
}
