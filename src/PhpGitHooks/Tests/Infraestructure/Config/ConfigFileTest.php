<?php

namespace PhpGitHooks\Tests\Infraestructure\Config;

use Mockery\Mock;
use PhpGitHooks\Infraestructure\Config\ConfigFile;
use PhpGitHooks\Infraestructure\Config\ConfigFileValidator;
use PhpGitHooks\Infraestructure\Config\ConfigFileReader;
use PhpGitHooks\Infraestructure\Config\ConfigFileNotFoundException;
use PhpGitHooks\Infraestructure\Config\InvalidConfigStructureException;

/**
 * Class ConfigFileTest
 * @package Infraestructure\Config
 */
class ConfigFileTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfigFile */
    private $configFile;
    /** @var  Mock */
    private $configFileValidator;
    /** @var  Mock */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileValidator = \Mockery::mock(ConfigFileValidator::class);
        $this->configFileReader = \Mockery::mock(ConfigFileReader::class);
        $this->configFile = new ConfigFile($this->configFileValidator, $this->configFileReader);
    }

    /**
     * @test
     */
    public function configFileNotExistsAndReturnException()
    {
        $this->setExpectedException(ConfigFileNotFoundException::class);
        $this->configFileValidator->shouldReceive('validate')->andThrow(new ConfigFileNotFoundException());

        $this->configFile->getPreCommitConfiguration();
    }

    /**
     * @test
     */
    public function getPreCommitConfigurationReturnsInvalidConfigEstructureException()
    {
        $this->setExpectedException(InvalidConfigStructureException::class);
        $this->configFileValidator->shouldReceive('validate');
        $this->configFileReader->shouldReceive('getData')->andReturn([]);
        $this->configFile->getPreCommitConfiguration();
    }

    /**
     * @test
     */
    public function getPreCommitConfigurationReturnsSuccesfull()
    {
        $data = [
            'pre-commit' => ['execute' => [
                    'phpunit' => true,
                ]],
        ];

        $this->configFileValidator->shouldReceive('validate');
        $this->configFileReader->shouldReceive('getData')->andReturn($data);
        $this->assertTrue(is_array($this->configFile->getPreCommitConfiguration()));
    }
}
