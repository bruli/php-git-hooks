<?php

namespace PhpGitHooks\Module\Files\Contract\Query;

use Bruli\EventBusBundle\QueryBus\QueryHandlerInterface;
use Bruli\EventBusBundle\QueryBus\QueryInterface;
use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;
use PhpGitHooks\Module\Files\Domain\FilesCollection;

class PhpFilesExtractorHandler extends AbstractFilesExtractorQueryHandler implements QueryHandlerInterface
{
    /**
     * @param FilesCollection $filesCollection
     *
     * @return PhpFilesResponse
     */
    private function extract(FilesCollection $filesCollection)
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

    /**
     * @param QueryInterface|PhpFilesExtractorQuery $query
     *
     * @return PhpFilesResponse
     */
    public function handle(QueryInterface $query)
    {
        $files = $this->getFiles($query->getFiles());

        return $this->extract(new FilesCollection($files));
    }
}
