<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface CheckFileInterface
 * @package PhpGitHooks\Infrastructure\Common
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
