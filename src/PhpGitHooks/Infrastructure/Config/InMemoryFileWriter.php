<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\FileWriterInterface;

/**
 * Class InMemoryFileWriter.
 */
class InMemoryFileWriter implements FileWriterInterface
{
    /**
     * @param string $file
     * @param array  $data
     */
    public function write($file, $data)
    {
    }
}
