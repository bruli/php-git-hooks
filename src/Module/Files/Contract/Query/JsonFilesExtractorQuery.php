<?php

namespace Module\Files\Contract\Query;

class JsonFilesExtractorQuery
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
