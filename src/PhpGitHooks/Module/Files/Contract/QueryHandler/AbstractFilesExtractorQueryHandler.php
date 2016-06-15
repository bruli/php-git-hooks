<?php

namespace PhpGitHooks\Module\Files\Contract\QueryHandler;

use PhpGitHooks\Module\Files\Domain\File;

abstract class AbstractFilesExtractorQueryHandler
{
    /**
     * @param array $files
     *
     * @return File[]
     */
    protected function getFiles(array $files)
    {
        $filesEntity = [];

        foreach ($files as $file) {
            $filesEntity[] = new File($file);
        }

        return $filesEntity;
    }
}
