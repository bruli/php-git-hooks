<?php

namespace PhpGitHooks\Tests\Application\CodeSniffer;

use Mockery\Mock;
use PhpGitHooks\Application\CodeSniffer\CheckCodeStyleCodeSnifferPreCommitExecuter;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;

/**
 * Class CheckCodeStyleCodeSnifferPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\CodeSniffer
 */
class CheckCodeStyleCodeSnifferPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckCodeStyleCodeSnifferPreCommitExecuter */
    private $checkCodeStyleCodeSnifferPreCommitExecuter;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var  Mock */
    private $codeSnifferHandler;
    /** @var InMemoryOutputInterface */
    private $outputInterface;

    protected function setUp()
    {
        $this->outputInterface = new InMemoryOutputInterface();
        $this->preCommitConfig = new InMemoryHookConfig();
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
        $this->preCommitConfig->setEnabled(false);

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
        $this->preCommitConfig->setEnabled(true);

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
