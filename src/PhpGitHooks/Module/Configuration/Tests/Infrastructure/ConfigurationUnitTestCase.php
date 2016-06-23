<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

abstract class ConfigurationUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use ConfigurationFileReaderTrait;
    use IoInterfaceTrait;
    use ConfigurationFileWriterTrait;
    use HookCopierTrait;
}
