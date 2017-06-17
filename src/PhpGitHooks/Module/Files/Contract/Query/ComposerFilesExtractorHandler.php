<?php

namespace PhpGitHooks\Module\Files\Contract\Query;

use PhpGitHooks\Module\Files\Contract\Response\ComposerFilesResponse;
use PhpGitHooks\Module\Files\Domain\File;
use PhpGitHooks\Module\Files\Domain\FilesCollection;

class ComposerFilesExtractorHandler extends AbstractFilesExtractorQueryHandler
{
    /**
     * @param FilesCollection $filesCollection
     *
     * @return ComposerFilesResponse
     */
    private function extract(FilesCollection $filesCollection)
    {
        return new ComposerFilesResponse(
            $this->setExists($filesCollection->getFiles()),
            $this->setJsonFile($filesCollection->getFiles()),
            $this->setLockFile($filesCollection->getFiles())
        );
    }

    /**
     * @param File[] $files
     *
     * @return bool
     */
    private function setExists(array $files)
    {
        $exists = false;
        foreach ($files as $file) {
            if (true === (bool) preg_match('/^composer\.(json|lock)$/', $file->value())) {
                $exists = true;
            }
        }

        return $exists;
    }

    /**
     * @param File[] $files
     *
     * @return bool
     */
    private function setJsonFile(array $files)
    {
        $return = false;
        foreach ($files as $file) {
            if ('composer.json' === $file->value()) {
                $return = true;
            }
        }

        return $return;
    }

    /**
     * @param File[] $files
     *
     * @return bool
     */
    private function setLockFile(array $files)
    {
        $return = false;
        foreach ($files as $file) {
            if ('composer.lock' === $file->value()) {
                $return = true;
            }
        }

        return $return;
    }

    /**
     * @param ComposerFilesExtractor $composerFilesFilesExtractorQuery
     *
     * @return ComposerFilesResponse
     */
    public function handle(ComposerFilesExtractor $composerFilesFilesExtractorQuery)
    {
        $files = $this->getFiles($composerFilesFilesExtractorQuery->getFiles());

        return $this->extract(new FilesCollection($files));
    }
}
