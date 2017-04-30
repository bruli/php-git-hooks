<?php

namespace PhpGitHooks\Module\PhpCsFixer\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

class PhpCsFixerUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use QueryBusTrait;
    use PhpCsFixerToolProcessorTrait;
    use OutputInterfaceTrait;
}
