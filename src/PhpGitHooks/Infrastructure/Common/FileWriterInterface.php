<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Interface FileWriterInterface.
 */
interface FileWriterInterface
{
    /**
     * @param string $file
     * @param array  $data
     */
    public function write($file, $data);
}
