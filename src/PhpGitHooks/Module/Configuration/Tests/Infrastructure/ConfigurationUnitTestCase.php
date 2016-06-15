<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Infrastructure\Hook\HookCopier;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileWriterInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\BaseUnitTestCase;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

abstract class ConfigurationUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use ConfigurationFileReaderTrait;
    use IoInterfaceTrait;
    use ConfigurationFileWriterTrait;
    use HookCopierTrait;
}
