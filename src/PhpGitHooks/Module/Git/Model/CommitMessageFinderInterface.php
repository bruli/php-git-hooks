<?php

namespace PhpGitHooks\Module\Git\Model;

interface CommitMessageFinderInterface
{
    /**
     * @param string $file
     *
     * @return string
     */
    public function find($file);
}
