<?php

namespace Module\PhpCs\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpCsUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use OutputInterfaceTrait;
    use PhpCsToolProcessorTrait;
}
