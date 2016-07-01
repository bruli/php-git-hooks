<?php

namespace PhpGitHooks\Module\Git\Infrastructure\Git;

use PhpGitHooks\Module\Git\Model\ReaderInterface;

class GitIgnoreFileReader implements ReaderInterface
{
    /**
     * @return string
     */
    public function read()
    {
        return file_get_contents('.gitignore');
    }
}
