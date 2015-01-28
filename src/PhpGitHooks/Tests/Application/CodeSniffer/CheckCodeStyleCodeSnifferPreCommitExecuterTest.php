<?php

namespace PhpGitHooks\Tests\Application\CodeSniffer;

use Mockery\Mock;
use PhpGitHooks\Application\CodeSniffer\CheckCodeStyleCodeSnifferPreCommitExecuter;

/**
 * Class CheckCodeStyleCodeSnifferPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\CodeSniffer
 */
class CheckCodeStyleCodeSnifferPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckCodeStyleCodeSnifferPreCommitExecuter */
    private $checkCodeStyleCodeSnifferPreCommitExecuter;
    /** @var  Mock */
    private $preCommitConfig;
    /** @var  Mock */
    private $codeSnifferHandler;
    /** @var  Mock */
    private $outputInterface;

    protected function setUp()
    {
        $this->outputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $this->preCommitConfig = \Mockery::mock('PhpGitHooks\Application\Config\PreCommitConfig');
        $this->codeSnifferHandler = \Mockery::mock('PhpGitHooks\Infrastructure\CodeSniffer\CodeSnifferHandler');
        $this->checkCodeStyleCodeSnifferPreCommitExecuter  = new CheckCodeStyleCodeSnifferPreCommitExecuter(
            $this->preCommitConfig,
            $this->codeSnifferHandler
        );
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(false);

        $this->checkCodeStyleCodeSnifferPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'needle'
        );
    }

    /**
     * @test
     */
    public function isEnable()
    {
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(true);
        $this->codeSnifferHandler->shouldReceive('setOutput');
        $this->codeSnifferHandler->shouldReceive('setFiles');
        $this->codeSnifferHandler->shouldReceive('setNeddle');
        $this->codeSnifferHandler->shouldReceive('run');

        $this->checkCodeStyleCodeSnifferPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'needle'
        );
    }
}
