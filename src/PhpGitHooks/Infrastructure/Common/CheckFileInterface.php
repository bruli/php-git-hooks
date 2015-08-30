<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface CheckFileInterface.
 */
interface CheckFileInterface
{
    /**
     * @return bool
     */
    public function exists();

    /**
     * @return string
     */
    public function getFile();
}
