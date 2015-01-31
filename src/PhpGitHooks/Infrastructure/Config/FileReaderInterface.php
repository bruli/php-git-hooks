<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Interface FileReaderInterface
 * @package PhpGitHooks\Infrastructure\Config
 */
interface FileReaderInterface
{
    /**
     * @return array
     */
    public function getData();
}
