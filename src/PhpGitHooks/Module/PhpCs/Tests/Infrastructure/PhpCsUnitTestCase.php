<?php

namespace PhpGitHooks\Module\PhpCs\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpCsUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use OutputInterfaceTrait;
    use PhpCsToolProcessorTrait;
}
