<?php

namespace PhpGitHooks\Module\Files\Contract\Query;

use PhpGitHooks\Infrastructure\QueryBus\QueryInterface;

class JsonFilesExtractorQuery implements QueryInterface
{
    /**
     * @var array
     */
    private $files;

    /**
     * JsonFilesExtractorQuery constructor.
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
