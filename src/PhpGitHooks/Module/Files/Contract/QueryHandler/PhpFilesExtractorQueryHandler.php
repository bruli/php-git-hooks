<?php

namespace PhpGitHooks\Module\Files\Contract\QueryHandler;

use PhpGitHooks\Infrastructure\QueryBus\QueryHandlerInterface;
use PhpGitHooks\Infrastructure\QueryBus\QueryInterface;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;
use PhpGitHooks\Module\Files\Domain\FilesCollection;
use PhpGitHooks\Module\Files\Service\PhpFilesExtractor;

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
