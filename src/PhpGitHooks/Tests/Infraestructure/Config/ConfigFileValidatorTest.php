<?php

namespace PhpGitHooks\Tests\Infraestructure\Config;

use Mockery\Mock;
use PhpGitHooks\Infraestructure\Config\ConfigFileValidator;
use PhpGitHooks\Infraestructure\Config\CheckConfigFile;
use PhpGitHooks\Infraestructure\Config\ConfigFileNotFoundException;

/**
 * Class ConfigFileValidatorTest
 * @package PhpGitHooks\Tests\Core\Config
 */
class ConfigFileValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfigFileValidator */
    private $configFileValidator;
    /** @var  Mock */
    private $checkConfigFile;

    protected function setUp()
    {
        $this->checkConfigFile = \Mockery::mock(CheckConfigFile::class);
        $this->configFileValidator = new ConfigFileValidator($this->checkConfigFile);
    }

    /**
     * @test
     */
    public function validateReturnsNotFoundException()
    {
        $this->setExpectedException(ConfigFileNotFoundException::class);

        $this->checkConfigFile->shouldReceive('exists')->andReturn(false);

        $this->configFileValidator->validate();
    }

    /**
     * @test
     */
    public function validateIsSuccessful()
    {
        $this->checkConfigFile->shouldReceive('exists')->andReturn(true);

        $this->assertEquals(null, $this->configFileValidator->validate());
    }
}
