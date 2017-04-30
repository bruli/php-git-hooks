<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\CommandBusTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\InputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;
use PHPUnit\Framework\TestCase;

abstract class GitUnitTestCase extends TestCase
{
    use MockeryPHPUnitIntegration;
    use QueryBusTrait;
    use CommandBusTrait;
    use FilesCommittedExtractorTrait;
    use OutputInterfaceTrait;
    use ToolTitleOutputWriterTrait;
    use MergeValidatorTrait;
    use CommitMessageFinderTrait;
    use InputInterfaceTrait;
    use PrePushOriginalExecutorTrait;
    use GitIgnoreFileReaderTrait;
    use WriterInterfaceTrait;
}
