<?php

namespace PhpGitHooks\Module\Composer\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

abstract class ComposerUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use OutputInterfaceTrait;
    use QueryBusTrait;
}
