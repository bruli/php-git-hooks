<?php

namespace PhpGitHooks\Module\Files\Service;

use PhpGitHooks\Module\Files\Contract\Response\JsonFilesResponse;
use PhpGitHooks\Module\Files\Domain\FilesCollection;

class JsonFilesExtractor
{
    /**
     * @param FilesCollection $filesCollection
     *
     * @return JsonFilesResponse
     */
    public function extract(FilesCollection $filesCollection)
    {
        $jsonFiles = $this->getJsonFiles($filesCollection);

        return new JsonFilesResponse($jsonFiles);
    }

    /**
     * @param FilesCollection $filesCollection
     *
     * @return array
     */
    private function getJsonFiles(FilesCollection $filesCollection)
    {
        $jsonFiles = [];

        foreach ($filesCollection->getFiles() as $file) {
            if (true === (bool) preg_match('/^(.*)(\.json)$/', $file->value())) {
                $jsonFiles[] = $file->value();
            }
        }

        return $jsonFiles;
    }
}
