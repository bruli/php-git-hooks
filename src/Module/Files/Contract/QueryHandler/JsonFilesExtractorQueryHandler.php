<?php

namespace Module\Files\Contract\QueryHandler;

use Infrastructure\QueryBus\QueryHandlerInterface;
use Infrastructure\QueryBus\QueryInterface;
use Module\Files\Contract\Query\JsonFilesExtractorQuery;
use Module\Files\Contract\Response\JsonFilesResponse;
use Module\Files\Domain\FilesCollection;
use Module\Files\Service\JsonFilesExtractor;

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
