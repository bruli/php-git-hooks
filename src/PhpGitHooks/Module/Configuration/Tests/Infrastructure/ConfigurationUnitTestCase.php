<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\CommandBusTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

abstract class ConfigurationUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use ConfigurationFileReaderTrait;
    use IoInterfaceTrait;
    use ConfigurationFileWriterTrait;
    use HookCopierTrait;
    use QueryBusTrait;
    use CommandBusTrait;
}
