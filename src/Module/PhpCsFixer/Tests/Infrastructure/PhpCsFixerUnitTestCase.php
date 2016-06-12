<?php

namespace Module\PhpCsFixer\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use Module\PhpCs\Tests\Infrastructure\PhpCsToolProcessorTrait;
use Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpCsFixerUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use PhpCsFixerToolProcessorTrait;
    use OutputInterfaceTrait;
}
