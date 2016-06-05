<?php

namespace Module\Files\Contract\Response;

class JsonFilesResponse
{
    /**
     * @var array
     */
    private $files;

    /**
     * JsonFilesResponse constructor.
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
