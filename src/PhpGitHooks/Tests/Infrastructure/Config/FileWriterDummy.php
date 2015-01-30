<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\FileWriter;

/**
 * Class FileWriterDummy
 * @package PhpGitHooks\Tests\Infrastructure\Config
 */
class FileWriterDummy implements FileWriter
{
    /**
     * @param string $file
     * @param array  $data
     */
    public function write($file, $data)
    {
    }
}
