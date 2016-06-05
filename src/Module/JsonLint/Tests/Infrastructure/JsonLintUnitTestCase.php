<?php

namespace Module\JsonLint\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;

class JsonLintUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use JsonLintProcessorTrait;
}
