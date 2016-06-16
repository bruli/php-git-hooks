<?php

namespace PhpGitHooks\Module\Git\Infrastructure\Git;

use PhpGitHooks\Module\Git\Model\CommitMessageFinderInterface;

class CommitMessageFinder implements CommitMessageFinderInterface
{
    /**
     * @param string $file
     *
     * @return string
     */
    public function find($file)
    {
        return file_get_contents($file);
    }
}
