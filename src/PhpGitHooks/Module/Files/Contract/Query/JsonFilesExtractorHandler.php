<?php

namespace PhpGitHooks\Module\Files\Contract\Query;

use Bruli\EventBusBundle\QueryBus\QueryHandlerInterface;
use Bruli\EventBusBundle\QueryBus\QueryInterface;
use PhpGitHooks\Module\Files\Contract\Response\JsonFilesResponse;
use PhpGitHooks\Module\Files\Domain\FilesCollection;

class JsonFilesExtractorHandler extends AbstractFilesExtractorQueryHandler implements QueryHandlerInterface
{
    /**
     * @param FilesCollection $filesCollection
     *
     * @return JsonFilesResponse
     */
    private function extract(FilesCollection $filesCollection)
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
            if (true === (bool)preg_match('/^(.*)(\.json)$/', $file->value())) {
                $jsonFiles[] = $file->value();
            }
        }

        return $jsonFiles;
    }

    /**
     * @param QueryInterface|JsonFilesExtractor $query
     *
     * @return JsonFilesResponse
     */
    public function handle(QueryInterface $query)
    {
        $files = $query->getFiles();

        return $this->extract(new FilesCollection($this->getFiles($files)));
    }
}
