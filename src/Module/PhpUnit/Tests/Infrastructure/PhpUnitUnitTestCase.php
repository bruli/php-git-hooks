<?php

namespace Module\PhpUnit\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;

class PhpUnitUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use PhpUnitProcessorTrait;
}
