<?php

namespace Module\PhpMd\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpMdUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use OutputInterfaceTrait;
    use PhpMdToolProcessorTrait;
}
