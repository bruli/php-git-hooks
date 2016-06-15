<?php

namespace PhpGitHooks\Module\Composer\Tests\Infrastructure;

use PhpGitHooks\Module\Files\Tests\Infrastructure\ComposerFilesExtractorQueryHandlerTrait;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

abstract class ComposerUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use QueryBusTrait;
}
