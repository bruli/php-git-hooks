<?php

namespace PhpGitHooks\Module\Git\Infrastructure\Git;

use PhpGitHooks\Module\Git\Model\WriterInterface;

class GitIgnoreFileWriter implements WriterInterface
{
    /**
     * @param mixed $data
     */
    public function write($data)
    {
        file_put_contents('.gitignore', $data);
    }
}
