<?php

namespace PhpGitHooks\Module\PhpUnit\Model;

interface GuardCoverageFileReaderInterface
{
    /**
     * @return float
     */
    public function read();
}
