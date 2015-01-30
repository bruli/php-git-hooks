<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileWriterInterface
 * @package PhpGitHooks\Infrastructure\Common
 */
interface FileWriterInterface
{
    /**
     * @param string $file
     * @param array  $data
     */
    public function write($file, $data);
}
