<?php

namespace PhpGitHooks\Infrastructure\Config;

interface ConfigFileReaderInterface
{
    /**
     * @return array
     */
    public function getFileContents();
}
