<?php

namespace PhpGitHooks\Infraestructure\CommitMessage;

/**
 * Class ExtractCommitMessage
 * @package Infraestructure\CommitMessage
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
