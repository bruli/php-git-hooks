<?php

namespace PhpGitHooks\Tests\Infrastructure\Config;

use Mockery\Mock;
use PhpGitHooks\Application\Config\ConfigFile;
use PhpGitHooks\Application\Config\ConfigFileNotFoundException;
use PhpGitHooks\Infrastructure\Config\InMemoryFileReader;

/**
 * Class ConfigFileTest.
 */
class ConfigFileTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfigFile */
    private $configFile;
    /** @var  Mock */
    private $configFileValidator;
    /** @var  InMemoryFileReader */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileValidator = \Mockery::mock('PhpGitHooks\Application\Config\ConfigFileValidator');
        $this->configFileReader = new InMemoryFileReader();
        $this->configFile = new ConfigFile($this->configFileValidator, $this->configFileReader);
    }

    /**
     * @test
     */
    public function configFileNotExistsAndReturnException()
    {
        $this->setExpectedException('PhpGitHooks\Application\Config\ConfigFileNotFoundException');
        $this->configFileValidator->shouldReceive('validate')->andThrow(new ConfigFileNotFoundException());

        $this->configFile->getPreCommitConfiguration();
    }

    /**
     * @test
     */
    public function getPreCommitConfigurationReturnsInvalidConfigEstructureException()
    {
        $this->setExpectedException('PhpGitHooks\Infrastructure\Config\InvalidConfigStructureException');
        $this->configFileValidator->shouldReceive('validate');
        $this->configFileReader->setData([]);
        $this->configFile->getPreCommitConfiguration();
    }

    /**
     * @test
     */
    public function getPreCommitConfigurationReturnsSuccesfull()
    {
        $data = array(
            'pre-commit' => array('execute' => array(
                'phpunit' => true,
            )),
        );

        $this->configFileValidator->shouldReceive('validate');
        $this->configFileReader->setData($data);
        $this->assertTrue(is_array($this->configFile->getPreCommitConfiguration()));
    }

    /**
     * @test
     */
    public function getMessageCommitConfigurationReturnsSuccesfull()
    {
        $data = array(
            'commit-msg' => array('regular-expression' => 'expression',
            ),
        );

        $this->configFileValidator->shouldReceive('validate');
        $this->configFileReader->setData($data);
        $this->assertTrue(is_array($this->configFile->getMessageCommitConfiguration()));
    }
}
