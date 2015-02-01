<?php

namespace PhpGitHooks\Tests\Infrastructure\Common;

use PhpGitHooks\Infrastructure\Common\ConfigFileToolValidator;

/**
 * Class ConfigFileToolValidatorTest
 * @package PhpGitHooks\Tests\Infrastructure\Common
 */
class ConfigFileToolValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfigFileToolValidator */
    private $validator;

    protected function setUp()
    {
        $this->validator = new ConfigFileToolValidator();
    }

    /**
     * @test
     */
    public function fileNotExists()
    {
        $this->validator->setFiles(['inexistentFile']);

        $this->assertFalse($this->validator->validate());
    }

    /**
     * @test
     */
    public function fileExistsSuccessful()
    {
        $path = __DIR__.'/../../../../../';
        $this->validator->setFiles([$path.'phpunit.xml', $path.'phpunit.xml.dist']);

        $this->assertTrue($this->validator->validate());
    }
}
