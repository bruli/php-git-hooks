<?php

namespace PhpGitHooks\Module\Files\Contract\QueryHandler;

use CommandBus\QueryBus\QueryHandlerInterface;
use CommandBus\QueryBus\QueryInterface;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\Response\JsonFilesResponse;
use PhpGitHooks\Module\Files\Domain\FilesCollection;
use PhpGitHooks\Module\Files\Service\JsonFilesExtractor;

class JsonFilesExtractorQueryHandler extends AbstractFilesExtractorQueryHandler implements QueryHandlerInterface
{
    /**
     * @var JsonFilesExtractor
     */
    private $jsonFilesExtractor;

    /**
     * JsonFilesExtractorQueryHandler constructor.
     *
     * @param JsonFilesExtractor $jsonFilesExtractor
     */
    public function __construct(JsonFilesExtractor $jsonFilesExtractor)
    {
        $this->jsonFilesExtractor = $jsonFilesExtractor;
    }

    /**
     * @param QueryInterface|JsonFilesExtractorQuery $query
     *
     * @return JsonFilesResponse
     */
    public function handle(QueryInterface $query)
    {
        $files = $query->getFiles();

        return $this->jsonFilesExtractor->extract(new FilesCollection($this->getFiles($files)));
    }
}
