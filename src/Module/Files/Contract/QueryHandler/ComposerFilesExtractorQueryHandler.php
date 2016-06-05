<?php

namespace Module\Files\Contract\QueryHandler;

use Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use Module\Files\Contract\Response\ComposerFilesResponse;
use Module\Files\Domain\FilesCollection;
use Module\Files\Service\ComposerFilesExtractor;

class ComposerFilesExtractorQueryHandler extends AbstractFilesExtractorQueryHandler
{
    /**
     * @var ComposerFilesExtractor
     */
    private $composerFilesExtractor;

    /**
     * ComposerFilesExtractorQueryHandler constructor.
     *
     * @param ComposerFilesExtractor $composerFilesExtractor
     */
    public function __construct(ComposerFilesExtractor $composerFilesExtractor)
    {
        $this->composerFilesExtractor = $composerFilesExtractor;
    }

    /**
     * @param ComposerFilesExtractorQuery $composerFilesFilesExtractorQuery
     *
     * @return ComposerFilesResponse
     */
    public function handle(ComposerFilesExtractorQuery $composerFilesFilesExtractorQuery)
    {
        $files = $this->getFiles($composerFilesFilesExtractorQuery->getFiles());

        return $this->composerFilesExtractor->extract(new FilesCollection($files));
    }
}
