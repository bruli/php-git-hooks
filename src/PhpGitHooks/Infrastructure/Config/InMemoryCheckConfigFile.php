<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Infrastructure\Common\CheckFileInterface;

/**
 * Class InMemoryCheckConfigFile
 * @package PhpGitHooks\Infrastructure\Config
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
        // TODO: Implement getFile() method.
    }

    /**
     * @param boolean $exists
     */
    public function setExists($exists)
    {
        $this->exists = $exists;
    }
}
