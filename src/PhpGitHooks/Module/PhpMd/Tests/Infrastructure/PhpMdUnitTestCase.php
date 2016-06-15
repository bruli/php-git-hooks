<?php

namespace PhpGitHooks\Module\PhpMd\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpMdUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use OutputInterfaceTrait;
    use PhpMdToolProcessorTrait;
}
