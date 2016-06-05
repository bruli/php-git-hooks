<?php

namespace Module\PhpLint\Tests\Infrastructure;

use Module\Git\Tests\Infrastructure\OutputInterfaceTrait;

class PhpLintUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use PhpLintToolProcessorTrait;
    use OutputInterfaceTrait;
}
