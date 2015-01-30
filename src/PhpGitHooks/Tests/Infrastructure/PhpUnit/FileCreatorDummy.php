<?php

namespace PhpGitHooks\Tests\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\FileCreator;

/**
 * Class FileCreatorDummy
 * @package PhpGitHooks\Tests\Infrastructure\PhpUnit
 */
class FileCreatorDummy implements FileCreator
{
    public function create()
    {
    }
}
