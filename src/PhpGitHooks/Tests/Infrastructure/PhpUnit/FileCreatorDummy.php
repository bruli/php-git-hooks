<?php

namespace PhpGitHooks\Tests\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\FileCreatorInterface;

/**
 * Class FileCreatorDummy
 * @package PhpGitHooks\Tests\Infrastructure\PhpUnit
 */
class FileCreatorDummy implements FileCreatorInterface
{
    public function create()
    {
    }
}
