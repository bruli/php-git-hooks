<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\FileWriterInterface;

/**
 * Class FileWriterDummy
 * @package PhpGitHooks\Tests\Infrastructure\Config
 */
class FileWriterDummy implements FileWriterInterface
{
    /**
     * @param string $file
     * @param array  $data
     */
    public function write($file, $data)
    {
    }
}
