<?php

namespace Module\Files\Contract\QueryHandler;

use Infrastructure\QueryBus\QueryHandlerInterface;
use Infrastructure\QueryBus\QueryInterface;
use Module\Files\Contract\Query\PhpFilesExtractorQuery;
use Module\Files\Contract\Response\PhpFilesResponse;
use Module\Files\Domain\FilesCollection;
use Module\Files\Service\PhpFilesExtractor;

class PhpFilesExtractorQueryHandler extends AbstractFilesExtractorQueryHandler implements QueryHandlerInterface
{
    /**
     * @var PhpFilesExtractor
     */
    private $phpFilesExtractor;

    /**
     * PhpFilesExtractorQueryHandler constructor.
     *
     * @param PhpFilesExtractor $phpFilesExtractor
     */
    public function __construct(PhpFilesExtractor $phpFilesExtractor)
    {
        $this->phpFilesExtractor = $phpFilesExtractor;
    }

    /**
     * @param QueryInterface|PhpFilesExtractorQuery $query
     *
     * @return PhpFilesResponse
     */
    public function handle(QueryInterface $query)
    {
        $files = $this->getFiles($query->getFiles());

        return $this->phpFilesExtractor->extract(new FilesCollection($files));
    }
}
