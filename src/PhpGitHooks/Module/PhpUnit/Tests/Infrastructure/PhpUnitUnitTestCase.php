<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;
use PHPUnit\Framework\TestCase;

class PhpUnitUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use OutputInterfaceTrait;
    use PhpUnitProcessorTrait;
    use StrictCoverageProcessorTrait;
    use GuardCoverageFileReaderTrait;
    use GuardCoverageFileWriterTrait;
}
