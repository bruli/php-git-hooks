<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use Mockery\Mock;
use PhpGitHooks\Infrastructure\Config\ConfigFileValidator;
use PhpGitHooks\Infrastructure\Config\CheckConfigFile;
use PhpGitHooks\Infrastructure\Config\ConfigFileNotFoundException;

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
        $this->checkConfigFile = \Mockery::mock('PhpGitHooks\Infrastructure\Config\CheckConfigFile');
        $this->configFileValidator = new ConfigFileValidator($this->checkConfigFile);
    }

    /**
     * @test
     */
    public function validateReturnsNotFoundException()
    {
        $this->setExpectedException('PhpGitHooks\Infrastructure\Config\ConfigFileNotFoundException');

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
