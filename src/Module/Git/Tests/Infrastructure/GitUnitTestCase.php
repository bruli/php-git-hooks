<?php

namespace Module\Git\Tests\Infrastructure;

use Module\Composer\Tests\Infrastructure\ComposerToolCommandHandlerTrait;
use Module\Configuration\Tests\Infrastructure\ConfigurationDataFinderQueryHandlerTrait;
use Module\JsonLint\Tests\Infrastructure\JsonLintToolCommandHandlerTrait;
use Module\PhpCs\Tests\Infrastructure\PhpCSToolCommandHandlerTrait;
use Module\PhpCsFixer\Tests\Infrastructure\PhpCsFixerToolCommandHandlerTrait;
use Module\PhpLint\Tests\Infrastructure\PhpLintToolCommandHandlerTrait;
use Module\PhpUnit\Tests\Infrastructure\PhpUnitToolCommandHandlerTrait;
use Module\Shared\Tests\Infrastructure\CommandBusTrait;
use Module\Shared\Tests\Infrastructure\QueryBusTrait;

abstract class GitUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use QueryBusTrait;
    use CommandBusTrait;
    use FilesCommittedExtractorTrait;
    use OutputInterfaceTrait;
    use ToolTitleOutputWriterTrait;
}
