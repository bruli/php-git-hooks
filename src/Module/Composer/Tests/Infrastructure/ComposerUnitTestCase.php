<?php

namespace Module\Composer\Tests\Infrastructure;

use Module\Files\Tests\Infrastructure\ComposerFilesExtractorQueryHandlerTrait;
use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;

abstract class ComposerUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use ComposerFilesExtractorQueryHandlerTrait;
}
