<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\FileCreatorInterface;

/**
 * Class ConfigFileCreator.
 */
class PhpUnitConfigFileCreator implements FileCreatorInterface
{
    public function create()
    {
        copy(__DIR__.'/../../../../phpunit.xml.dist', 'phpunit.xml.dist');
    }
}
