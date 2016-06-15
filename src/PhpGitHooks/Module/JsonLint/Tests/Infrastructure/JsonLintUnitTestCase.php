<?php

namespace PhpGitHooks\Module\JsonLint\Tests\Infrastructure;

use PhpGitHooks\Module\Files\Tests\Infrastructure\JsonFilesExtractorQueryHandlerTrait;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

class JsonLintUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use JsonLintProcessorTrait;
    use QueryBusTrait;
}
