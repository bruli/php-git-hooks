<?php

namespace PhpGitHooks\Infrastructure\Disk\Config;

interface ConfigFileWriterInterface
{
    /**
     * @param array $configData
     */
    public function write(array $configData);
}
