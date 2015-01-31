<?php

namespace PhpGitHooks\Tests\Application\Composer;

use PhpGitHooks\Application\Composer\CommitMsgProcessor;
use PhpGitHooks\Application\Composer\ConfiguratorProcessor;
use Mockery\Mock;
use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Application\PhpUnit\PhpUnitInitConfigFile;
use PhpGitHooks\Infrastructure\Common\InMemoryFileCopier;
use PhpGitHooks\Infrastructure\Common\InMemoryFilesValidator;
use PhpGitHooks\Infrastructure\Composer\InMemoryIOInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryFileWriter;
use PhpGitHooks\Infrastructure\PhpUnit\InMemoryFileCreator;

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
    /** @var  InMemoryIOInterface */
    private $IO;
    /** @var  CommitMsgProcessor */
    private $commitMsgProcessor;
    /** @var  Mock */
    private $hooksFileCopier;

    protected function setUp()
    {
        $this->IO = new InMemoryIOInterface();
        $this->checkConfigFile = \Mockery::mock('PhpGitHooks\Infrastructure\Config\CheckConfigFile');
        $this->hooksFileCopier = new InMemoryFileCopier();

        $this->phpUnitInitConfigFile = new PhpUnitInitConfigFile(
            new InMemoryFilesValidator(false),
            new InMemoryFileCreator()
        );

        $this->commitMsgProcessor = new CommitMsgProcessor($this->hooksFileCopier);
        $this->preCommitProcessor = new PreCommitProcessor($this->hooksFileCopier);

        $this->configuratorProcessor = new ConfiguratorProcessor(
            $this->checkConfigFile,
            $this->preCommitProcessor,
            new InMemoryFileWriter(),
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
