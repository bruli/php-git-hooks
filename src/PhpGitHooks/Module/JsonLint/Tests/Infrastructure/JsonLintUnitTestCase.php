<?php

namespace PhpGitHooks\Module\JsonLint\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

class JsonLintUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use OutputInterfaceTrait;
    use JsonLintProcessorTrait;
    use QueryBusTrait;
}
