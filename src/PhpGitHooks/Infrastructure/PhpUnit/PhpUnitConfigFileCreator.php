<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\FileCreator;

/**
 * Class ConfigFileCreator
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class PhpUnitConfigFileCreator implements FileCreator
{
    public function create()
    {
        copy(__DIR__.'/../../../../phpunit.xml.dist', 'phpunit.xml.dist');
    }
}
