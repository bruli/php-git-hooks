<?php

namespace PhpGitHooks\Tests\Infrastructure\Common;

use PhpGitHooks\Infrastructure\Common\FileCopier;

/**
 * Class FileCopierDummy
 * @package PhpGitHooks\Tests\Infrastructure\Common
 */
class FileCopierDummy implements FileCopier
{
    /**
     * @param string $file
     */
    public function copy($file)
    {
    }
}
