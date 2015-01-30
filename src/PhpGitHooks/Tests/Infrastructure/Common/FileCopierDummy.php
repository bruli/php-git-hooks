<?php

namespace PhpGitHooks\Tests\Infrastructure\Common;

use PhpGitHooks\Infrastructure\Common\FileCopierInterface;

/**
 * Class FileCopierDummy
 * @package PhpGitHooks\Tests\Infrastructure\Common
 */
class FileCopierDummy implements FileCopierInterface
{
    /**
     * @param string $file
     */
    public function copy($file)
    {
    }
}
