<?php

namespace Module\Configuration\Tests\Infrastructure;

use Composer\IO\IOInterface;
use Module\Configuration\Infrastructure\Hook\HookCopier;
use Module\Configuration\Model\ConfigurationFileReaderInterface;
use Module\Configuration\Model\ConfigurationFileWriterInterface;
use Module\Tests\Infrastructure\UnitTestCase\BaseUnitTestCase;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

abstract class ConfigurationUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use ConfigurationFileReaderTrait;
    use IoInterfaceTrait;
    use ConfigurationFileWriterTrait;
    use HookCopierTrait;
}
