<?php

namespace Module\Files\Service;

use Module\Files\Contract\Response\PhpFilesResponse;
use Module\Files\Domain\FilesCollection;

class PhpFilesExtractor
{
    /**
     * @param FilesCollection $filesCollection
     *
     * @return PhpFilesResponse
     */
    public function extract(FilesCollection $filesCollection)
    {
        $phFiles = $this->getPhpFiles($filesCollection);

        return new PhpFilesResponse($phFiles);
    }

    /**
     * @param FilesCollection $filesCollection
     *
     * @return array
     */
    private function getPhpFiles(FilesCollection $filesCollection)
    {
        $phpFiles = [];

        foreach ($filesCollection->getFiles() as $file) {
            if (true === (bool) preg_match('/^(.*)(\.php)|(\.inc)$/', $file->value())) {
                $phpFiles[] = $file->value();
            }
        }

        return $phpFiles;
    }
}
