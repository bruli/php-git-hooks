<?php

namespace PhpGitHooks\Module\PhpUnit\Infrastructure\Tool;

use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileReaderInterface;

class GuardCoverageFileReader implements GuardCoverageFileReaderInterface
{
    const FILE = '.guard_coverage';

    /**
     * @return string
     */
    public function read()
    {
        if (false === file_exists(self::FILE)) {
            return 0.00;
        }

        return file_get_contents(self::FILE);
    }
}
