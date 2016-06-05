<?php

namespace Module\Files\Contract\QueryHandler;

use Module\Files\Contract\Query\JsonFilesExtractorQuery;
use Module\Files\Contract\Response\JsonFilesResponse;
use Module\Files\Domain\FilesCollection;
use Module\Files\Service\JsonFilesExtractor;

class JsonFilesExtractorQueryHandler extends AbstractFilesExtractorQueryHandler
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
     * @param JsonFilesExtractorQuery $jsonFilesExtractorQuery
     *
     * @return JsonFilesResponse
     */
    public function handle(JsonFilesExtractorQuery $jsonFilesExtractorQuery)
    {
        $files = $jsonFilesExtractorQuery->getFiles();

        return $this->jsonFilesExtractor->extract(new FilesCollection($this->getFiles($files)));
    }
}
