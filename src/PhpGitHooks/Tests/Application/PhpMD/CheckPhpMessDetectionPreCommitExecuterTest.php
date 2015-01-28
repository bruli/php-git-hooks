<?php

namespace PhpGitHooks\Tests\Application\PhpMD;

use Mockery\Mock;
use PhpGitHooks\Application\CodeSniffer\CheckCodeStyleCodeSnifferPreCommitExecuter;
use PhpGitHooks\Application\PhpMD\CheckPhpMessDetectionPreCommitExecuter;

/**
 * Class CheckPhpMessDetectionPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpMD
 */
class CheckPhpMessDetectionPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckCodeStyleCodeSnifferPreCommitExecuter */
    private $checkPhpMessDetectionPreCommitExecuter;
    /** @var  Mock */
    private $preCommitConfig;
    /** @var   Mock */
    private $phpMDHandler;
    /** @var  Mock */
    private $outputInterface;

    protected function setUp()
    {
        $this->preCommitConfig = \Mockery::mock('PhpGitHooks\Application\Config\PreCommitConfig');
        $this->phpMDHandler = \Mockery::mock('PhpGitHooks\Infrastructure\PhpMD\PhpMDHandler');
        $this->outputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $this->checkPhpMessDetectionPreCommitExecuter = new CheckPhpMessDetectionPreCommitExecuter(
            $this->preCommitConfig,
            $this->phpMDHandler
        );
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(false);
        $this->checkPhpMessDetectionPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }

    /**
     * @test
     */
    public function isEnabled()
    {
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(true);
        $this->phpMDHandler->shouldReceive('setOutput');
        $this->phpMDHandler->shouldReceive('setFiles');
        $this->phpMDHandler->shouldReceive('setNeedle');
        $this->phpMDHandler->shouldReceive('run');

        $this->checkPhpMessDetectionPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
