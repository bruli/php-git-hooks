<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use PhpGitHooks\Application\Config\ConfigFileValidator;
use PhpGitHooks\Infrastructure\Config\InMemoryCheckConfigFile;

/**
 * Class ConfigFileValidatorTest
 * @package PhpGitHooks\Tests\Core\Config
 */
class ConfigFileValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfigFileValidator */
    private $configFileValidator;
    /** @var  InMemoryCheckConfigFile */
    private $checkConfigFile;

    protected function setUp()
    {
        $this->checkConfigFile = new InMemoryCheckConfigFile();
        $this->configFileValidator = new ConfigFileValidator($this->checkConfigFile);
    }

    /**
     * @test
     */
    public function validateReturnsNotFoundException()
    {
        $this->setExpectedException('PhpGitHooks\Application\Config\ConfigFileNotFoundException');

        $this->checkConfigFile->setExists(false);

        $this->configFileValidator->validate();
    }

    /**
     * @test
     */
    public function validateIsSuccessful()
    {
        $this->checkConfigFile->setExists(true);

        $this->assertEquals(null, $this->configFileValidator->validate());
    }
}
