<?php

namespace PhpGitHooks\Infrastructure\CommitMessage;

use PhpGitHooks\Infrastructure\Common\FileExtractInterface;

/**
 * Class ExtractCommitMessage
 * @package Infrastructure\CommitMessage
 */
class ExtractCommitMessage implements FileExtractInterface
{
    /**
     * @param  string $commitFile
     * @return string
     */
    public function extract($commitFile)
    {
        return file_get_contents($commitFile);
    }
}
