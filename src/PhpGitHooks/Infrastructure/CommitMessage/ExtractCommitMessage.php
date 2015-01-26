<?php

namespace PhpGitHooks\Infrastructure\CommitMessage;

/**
 * Class ExtractCommitMessage
 * @package Infrastructure\CommitMessage
 */
class ExtractCommitMessage
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
