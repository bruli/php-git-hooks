<?php

namespace PhpGitHooks\Module\PhpUnit\Infrastructure\Tool;

use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileWriterInterface;

class GuardCoverageFileWriter implements GuardCoverageFileWriterInterface
{
    /**
     * @param float $data
     */
    public function write($data)
    {
        file_put_contents('.guard_coverage', $data);
    }
}
