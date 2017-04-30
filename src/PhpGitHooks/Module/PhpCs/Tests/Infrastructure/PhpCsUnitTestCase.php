<?php

namespace PhpGitHooks\Module\PhpCs\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

class PhpCsUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use QueryBusTrait;
    use OutputInterfaceTrait;
    use PhpCsToolProcessorTrait;
}
