<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\ConfiguratorProcessor;
use Mockery\Mock;

/**
 * Class ConfiguratorProcessorTest
 * @package PhpGitHooks\Tests\Application\Composer
 */
class ConfiguratorProcessorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ConfiguratorProcessor */
    private $configuratorProcessor;
    /** @var  Mock */
    private $checkConfigFile;
    /** @var  Mock */
    private $preCommitProcessor;
    /** @var  Mock */
    private $configFileWriter;
    /** @var  Mock */
    private $phpUnitInitConfigFile;
    /** @var  Mock */
    private $IO;

    protected function setUp()
    {
        $this->IO = \Mockery::mock('Composer\IO\IOInterface');
        $this->checkConfigFile = \Mockery::mock('PhpGitHooks\Infrastructure\Config\CheckConfigFile');
        $this->preCommitProcessor = \Mockery::mock('PhpGitHooks\Application\Composer\PreCommitProcessor');
//        $this->preCommitProcessor->shouldReceive('setIO');
        $this->configFileWriter = \Mockery::mock('PhpGitHooks\Infrastructure\Config\ConfigFileWriter');
        $this->phpUnitInitConfigFile = \Mockery::mock('PhpGitHooks\Infrastructure\PhpUnit\PhpUnitInitConfigFile');
        $this->phpUnitInitConfigFile->shouldReceive('setIO');

        $this->configuratorProcessor = new ConfiguratorProcessor(
            $this->checkConfigFile,
            $this->preCommitProcessor,
            $this->configFileWriter,
            $this->phpUnitInitConfigFile
        );

        $this->configuratorProcessor->setIO($this->IO);
    }

    /**
     * @test
     */
    public function initConfigFileFileNotExists()
    {
        $this->IO->shouldReceive('ask')->andReturn('N');
        $this->IO->shouldReceive('write');
        $this->checkConfigFile->shouldReceive('exists')->andReturn(false);
        $this->phpUnitInitConfigFile->shouldReceive('process');

        $this->assertTrue($this->configuratorProcessor->process());
    }

    /**
     * @test
     */
    public function initConfigFileExecute()
    {
        $this->IO->shouldReceive('ask')->andReturn('Y');
        $this->IO->shouldReceive('write');
        $this->checkConfigFile->shouldReceive('exists')->andReturn(false);
        $this->phpUnitInitConfigFile->shouldReceive('process');
        $this->preCommitProcessor->shouldReceive('setIO');
        $this->preCommitProcessor->shouldReceive('execute');
        $this->checkConfigFile->shouldReceive('getFile');
        $this->configFileWriter->shouldReceive('write');

        $this->assertTrue($this->configuratorProcessor->process());
    }
}
