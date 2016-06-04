<?php

namespace Module\Git\Tests\Infrastructure;

use Module\Composer\Test\Infrastructure\ComposerToolCommandHandlerTrait;
use Module\Configuration\Tests\Infrastructure\ConfigurationDataFinderQueryHandlerTrait;
use Module\JsonLint\Tests\Infrastructure\JsonLintToolCommandHandlerTrait;
use Module\PhpCs\Tests\Infrastructure\PhpCSToolCommandHandlerTrait;
use Module\PhpCsFixer\Tests\Infrastructure\PhpCsFixerToolCommandHandlerTrait;
use Module\PhpLint\Tests\Infrastructure\PhpLintToolCommandHandlerTrait;
use Module\PhpUnit\Tests\Infrastructure\PhpUnitToolCommandHandlerTrait;

abstract class GitUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use ConfigurationDataFinderQueryHandlerTrait;
    use FilesCommittedExtractorTrait;
    use OutputInterfaceTrait;
    use ComposerToolCommandHandlerTrait;
    use JsonLintToolCommandHandlerTrait;
    use PhpLintToolCommandHandlerTrait;
    use PhpCSToolCommandHandlerTrait;
    use PhpCsFixerToolCommandHandlerTrait;
    use PhpUnitToolCommandHandlerTrait;
}
