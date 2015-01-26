<?php

namespace PhpGitHooks\Tests\Infraestructure\Common;

use PhpGitHooks\Infraestructure\Common\ConfigFileToolValidator;

/**
 * Class ConfigFileToolValidatorTest
 * @package PhpGitHooks\Tests\Infraestructure\Common
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

        $this->assertFalse($this->validator->existsConfigFile());
    }

    /**
     * @test
     */
    public function fileExistsSuccessful()
    {
        $path = __DIR__.'/../../../../../';
        $this->validator->setFiles([$path.'phpunit.xml', $path.'phpunit.xml.dist']);

        $this->assertTrue($this->validator->existsConfigFile());
    }
}
