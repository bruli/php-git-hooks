<?php

namespace PhpGitHooks\Module\PhpUnit\Infrastructure\Tool;

use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileReaderInterface;

class GuardCoverageFileReader implements GuardCoverageFileReaderInterface
{
    /**
     * @return string
     */
    public function read()
    {
        return file_get_contents('.guard_coverage');
    }
}
