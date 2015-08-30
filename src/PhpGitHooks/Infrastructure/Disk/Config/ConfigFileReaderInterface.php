<?php

namespace PhpGitHooks\Infrastructure\Disk\Config;

interface ConfigFileReaderInterface
{
    /**
     * @return array
     */
    public function getFileContents();
}
