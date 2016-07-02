<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use PhpGitHooks\Module\Shared\Tests\Infrastructure\CommandBusTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

abstract class ConfigurationUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use ConfigurationFileReaderTrait;
    use IoInterfaceTrait;
    use ConfigurationFileWriterTrait;
    use HookCopierTrait;
    use QueryBusTrait;
    use CommandBusTrait;
}
