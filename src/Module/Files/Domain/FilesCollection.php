<?php

namespace Module\Files\Domain;

use Assert\Assertion;

class FilesCollection
{
    /**
     * @var File[]
     */
    private $files;

    /**
     * FilesCollection constructor.
     *
     * @param File[] $files
     */
    public function __construct(array $files)
    {
        foreach ($files as $file) {
            Assertion::isInstanceOf($file, File::class);
        }
        $this->files = $files;
    }

    /**
     * @return File[]
     */
    public function getFiles()
    {
        return $this->files;
    }
}
