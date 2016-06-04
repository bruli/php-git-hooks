<?php

namespace Module\PhpLint\Contract\Command;

class PhpLintToolCommand
{
    /**
     * @var array
     */
    private $files;

    /**
     * PhpLintToolCommand constructor.
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
