<?php

namespace Module\JsonLint\Tests\Infrastructure;

use Module\Files\Tests\Infrastructure\JsonFilesExtractorQueryHandlerTrait;
use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use Module\Shared\Tests\Infrastructure\QueryBusTrait;

class JsonLintUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use JsonLintProcessorTrait;
    use QueryBusTrait;
}
