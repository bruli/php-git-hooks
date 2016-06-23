<?php

namespace PhpGitHooks\Module\PhpCsFixer\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

class PhpCsFixerUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use PhpCsFixerToolProcessorTrait;
    use OutputInterfaceTrait;
}
