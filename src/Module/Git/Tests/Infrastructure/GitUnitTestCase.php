<?php

namespace Module\Git\Tests\Infrastructure;

abstract class GitUnitTestCase extends \PHPUnit_Framework_TestCase
{
    use ConfigurationDataFinderTrait;
    use FilesCommittedExtractorTrait;
    use OutputInterfaceTrait;
}
