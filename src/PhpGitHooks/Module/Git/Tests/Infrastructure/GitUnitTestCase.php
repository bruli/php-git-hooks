<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

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
