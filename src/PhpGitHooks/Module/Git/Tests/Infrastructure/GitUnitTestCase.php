<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Composer\Tests\Infrastructure\ComposerToolCommandHandlerTrait;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\ConfigurationDataFinderQueryHandlerTrait;
use PhpGitHooks\Module\Configuration\Tests\Infrastructure\IoInterfaceTrait;
use PhpGitHooks\Module\JsonLint\Tests\Infrastructure\JsonLintToolCommandHandlerTrait;
use PhpGitHooks\Module\PhpCs\Tests\Infrastructure\PhpCSToolCommandHandlerTrait;
use PhpGitHooks\Module\PhpCsFixer\Tests\Infrastructure\PhpCsFixerToolCommandHandlerTrait;
use PhpGitHooks\Module\PhpLint\Tests\Infrastructure\PhpLintToolCommandHandlerTrait;
use PhpGitHooks\Module\PhpUnit\Tests\Infrastructure\PhpUnitToolCommandHandlerTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\CommandBusTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\InputInterfaceTrait;
use PhpGitHooks\Module\Shared\Tests\Infrastructure\QueryBusTrait;

abstract class GitUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use CommandBusTrait;
    use FilesCommittedExtractorTrait;
    use OutputInterfaceTrait;
    use ToolTitleOutputWriterTrait;
    use MergeValidatorTrait;
    use CommitMessageFinderTrait;
    use InputInterfaceTrait;
}
