<?php

namespace Module\JsonLint\Contract\Command;

class JsonLintToolCommand
{
    /**
     * @var array
     */
    private $files;

    /**
     * JsonLintToolCommand constructor.
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
