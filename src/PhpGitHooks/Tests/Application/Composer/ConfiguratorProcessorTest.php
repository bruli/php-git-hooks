<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\CommitMsgProcessor;
use PhpGitHooks\Application\Composer\ConfiguratorProcessor;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Application\PhpUnit\PhpUnitInitConfigFile;
use PhpGitHooks\Tests\Infrastructure\Common\FileCopierDummy;
use PhpGitHooks\Tests\Infrastructure\Common\FilesValidatorDummy;
use PhpGitHooks\Tests\Infrastructure\Config\FileWriterDummy;
use PhpGitHooks\Tests\Infrastructure\PhpUnit\FileCreatorDummy;
use PhpGitHooks\Tests\vendor\Composer\IO\IOInterfaceDummy;

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
    /** @var  PreCommitProcessor */
    private $preCommitProcessor;
    /** @var  Mock */
    private $phpUnitInitConfigFile;
    /** @var  IOInterfaceDummy */
    private $IO;
    /** @var  CommitMsgProcessor */
    private $commitMsgProcessor;
    /** @var  Mock */
    private $hooksFileCopier;

    /**
     *
     */
    protected function setUp()
    {
        $this->IO = new IOInterfaceDummy();
        $this->checkConfigFile = \Mockery::mock('PhpGitHooks\Infrastructure\Config\CheckConfigFile');
        $this->hooksFileCopier = new FileCopierDummy();

        $this->phpUnitInitConfigFile = new PhpUnitInitConfigFile(
            new FilesValidatorDummy(false),
            new FileCreatorDummy()
        );

        $this->commitMsgProcessor = new CommitMsgProcessor($this->hooksFileCopier);
        $this->preCommitProcessor = new PreCommitProcessor($this->hooksFileCopier);

        $this->configuratorProcessor = new ConfiguratorProcessor(
            $this->checkConfigFile,
            $this->preCommitProcessor,
            new FileWriterDummy(),
            $this->phpUnitInitConfigFile,
            $this->commitMsgProcessor
        );

        $this->configuratorProcessor->setIO($this->IO);
    }

    /**
     * @test
     */
    public function initConfigFileFileNotExists()
    {
        $this->IO->setAsk('n');
        $this->checkConfigFile->shouldReceive('getFile');
        $this->checkConfigFile->shouldReceive('exists')->andReturn(false);

        $this->assertTrue($this->configuratorProcessor->process());
    }

    /**
     * @test
     */
    public function initConfigFileExecute()
    {
        $this->IO->setAsk('y');
        $this->checkConfigFile->shouldReceive('exists')->andReturn(false);
        $this->checkConfigFile->shouldReceive('getFile');

        $this->assertTrue($this->configuratorProcessor->process());
    }
}
