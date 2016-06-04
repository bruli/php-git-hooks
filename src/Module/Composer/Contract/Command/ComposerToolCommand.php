<?php

namespace Module\Composer\Contract\Command;

class ComposerToolCommand
{
    /**
     * @var array
     */
    private $files;

    /**
     * ComposerToolCommand constructor.
     *
     * @param array $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
}
