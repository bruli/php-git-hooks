<?php

namespace PhpGitHooks\Module\Files\Contract\Response;

class PhpFilesResponse
{
    /**
     * @var array
     */
    private $files;

    /**
     * PhpFilesResponse constructor.
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
