<?php

namespace PhpGitHooks\Module\PhpLint\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

class PhpLintUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use PhpLintToolProcessorTrait;
    use OutputInterfaceTrait;
    use QueryBusTrait;
}
