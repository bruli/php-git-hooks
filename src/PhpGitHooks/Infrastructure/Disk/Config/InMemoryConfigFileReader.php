<?php

namespace PhpGitHooks\Infrastructure\Disk\Config;

final class InMemoryConfigFileReader implements ConfigFileReaderInterface
{
    public $fileContents = [];
    /**
     * @return array
     */
    public function getFileContents()
    {
        return $this->fileContents;
    }
}
