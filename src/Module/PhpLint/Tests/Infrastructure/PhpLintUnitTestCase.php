<?php

namespace Module\PhpLint\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpLintUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use PhpLintToolProcessorTrait;
    use OutputInterfaceTrait;
    use QueryBusTrait;
}
