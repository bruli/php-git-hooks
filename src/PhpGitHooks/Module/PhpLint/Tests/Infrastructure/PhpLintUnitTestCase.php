<?php

namespace PhpGitHooks\Module\PhpLint\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpLintUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use PhpLintToolProcessorTrait;
    use OutputInterfaceTrait;
    use QueryBusTrait;
}
