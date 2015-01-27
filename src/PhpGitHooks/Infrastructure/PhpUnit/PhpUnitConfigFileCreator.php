<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

/**
 * Class ConfigFileCreator
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class PhpUnitConfigFileCreator
{
    public function create()
    {
        copy(__DIR__.'/../../../../phpunit.xml.dist', 'phpunit.xml.dist');
    }
}
