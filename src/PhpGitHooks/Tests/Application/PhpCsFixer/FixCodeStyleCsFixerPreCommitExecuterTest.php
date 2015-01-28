<?php

namespace PhpGitHooks\Tests\Application\PhpCsFixer;

use PhpGitHooks\Application\PhpCsFixer\FixCodeStyleCsFixerPreCommitExecuter;
use Mockery\Mock;

/**
 * Class FixCodeStyleCsFixerPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpCsFixer
 */
class FixCodeStyleCsFixerPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  FixCodeStyleCsFixerPreCommitExecuter */
    private $fixCodeStyleCsFixerPreCommitExecuter;
    /** @var  Mock */
    private $preCommitConfig;
    /** @var  Mock */
    private $outputInterface;
    /** @var  Mock */
    private $phpCsFixerHandler;

    protected function setUp()
    {
        $this->preCommitConfig = \Mockery::mock('PhpGitHooks\Application\Config\PreCommitConfig');
        $this->outputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $this->phpCsFixerHandler = \Mockery::mock('PhpGitHooks\Infrastructure\PhpCsFixer\PhpCsFixerHandler');
        $this->fixCodeStyleCsFixerPreCommitExecuter = new FixCodeStyleCsFixerPreCommitExecuter(
            $this->preCommitConfig,
            $this->phpCsFixerHandler
        );
    }

    /**
     * @test
     */
    public function idDisabled()
    {
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(false);
        $this->fixCodeStyleCsFixerPreCommitExecuter->run(
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
        $this->phpCsFixerHandler->shouldReceive('setOutput');
        $this->phpCsFixerHandler->shouldReceive('setFiles');
        $this->phpCsFixerHandler->shouldReceive('setFilesToAnalize');
        $this->phpCsFixerHandler->shouldReceive('run');

        $this->fixCodeStyleCsFixerPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
