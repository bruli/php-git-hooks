<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileWriter
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FileWriter
{
    /**
     * @param string $file
     * @param array  $data
     */
    public function write($file, $data);
}
