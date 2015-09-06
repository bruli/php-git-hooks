<?php

namespace PhpGitHooks\Tests\Application\Config;

use PhpGitHooks\Application\Config\ConfigFile;
use PhpGitHooks\Infrastructure\Config\InvalidConfigStructureException;
use PhpGitHooks\Infrastructure\Disk\Config\InMemoryConfigFileReader;

class ConfigFileTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfigFile */
    private $configFile;
    /** @var  InMemoryConfigFileReader */
    private $configFileReader;

    protected function setUp()
    {
        $this->configFileReader = new InMemoryConfigFileReader();
        $this->configFile = new ConfigFile($this->configFileReader);
    }

    /**
     * @test
     */
    public function getPreCommitConfiguration()
    {
        $this->configFileReader->fileContents = ['pre-commit' => [
            'enabled' => true,
            'execute' => [],
        ]];

        $configData = $this->configFile->getPreCommitConfiguration();

        $this->assertSame([], $configData);
    }

    /**
     * @throws InvalidConfigStructureException
     *
     * @test
     */
    public function getPreCommitConfigurationThrowsException()
    {
        $this->setExpectedException(InvalidConfigStructureException::class);
        $this->configFileReader->fileContents = [];

        $this->configFile->getPreCommitConfiguration();
    }

    /**
     * @test
     */
    public function getCommitMsgConfiguration()
    {
        $this->configFileReader->fileContents = ['commit-msg' => [
            'enabled' => true,
            'regular-expression' => 'dkdklsls',
        ]];

        $configData = $this->configFile->getMessageCommitConfiguration();

        $this->assertArrayHasKey('enabled', $configData);
        $this->assertArrayHasKey('regular-expression', $configData);
    }

    /**
     * @throws InvalidConfigStructureException
     *
     * @test
     */
    public function getCommitMsgConfigurationThrowsException()
    {
        $this->setExpectedException(InvalidConfigStructureException::class);
        $this->configFileReader->fileContents = ['commit-msg' => []];

        $this->configFile->getMessageCommitConfiguration();
    }

    /**
     * @throws InvalidConfigStructureException
     *
     * @test
     */
    public function getCommitMsgConfigurationWithoutRegExpThrowsException()
    {
        $this->setExpectedException(InvalidConfigStructureException::class);
        $this->configFileReader->fileContents = ['commit-msg' => [
            'enabled' => true
        ]];

        $this->configFile->getMessageCommitConfiguration();
    }
}
