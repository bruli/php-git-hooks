<?php

namespace PhpGitHooks\Module\Files\Contract\Query;

class ComposerFilesExtractorQuery
{
    /**
     * @var array
     */
    private $files;

    /**
     * ComposerFilesExtractorQuery constructor.
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
