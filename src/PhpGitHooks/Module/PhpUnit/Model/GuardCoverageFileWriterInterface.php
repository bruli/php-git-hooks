<?php

namespace PhpGitHooks\Module\PhpUnit\Model;

interface GuardCoverageFileWriterInterface
{
    /**
     * @param float $data
     */
    public function write($data);
}
