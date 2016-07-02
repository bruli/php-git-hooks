<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Tests\Infrastructure\OutputInterfaceTrait;

class PhpUnitUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use OutputInterfaceTrait;
    use PhpUnitProcessorTrait;
    use StrictCoverageProcessorTrait;
    use GuardCoverageFileReaderTrait;
    use GuardCoverageFileWriterTrait;
}
