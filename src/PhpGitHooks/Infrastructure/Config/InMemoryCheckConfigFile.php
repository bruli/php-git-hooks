<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\CheckFileInterface;

/**
 * Class InMemoryCheckConfigFile.
 */
class InMemoryCheckConfigFile implements CheckFileInterface
{
    /** @var  bool */
    private $exists;
    /**
     * @return bool
     */
    public function exists()
    {
        return $this->exists;
    }

    /**
     * @return string
     */
    public function getFile()
    {
    }

    /**
     * @param bool $exists
     */
    public function setExists($exists)
    {
        $this->exists = $exists;
    }
}
