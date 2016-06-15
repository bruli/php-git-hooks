<?php

namespace PhpGitHooks\Module\Files\Contract\QueryHandler;

use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\Response\ComposerFilesResponse;
use PhpGitHooks\Module\Files\Domain\FilesCollection;
use PhpGitHooks\Module\Files\Service\ComposerFilesExtractor;

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
