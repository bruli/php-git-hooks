<?php

namespace PhpGitHooks\Infrastructure\Config;

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
