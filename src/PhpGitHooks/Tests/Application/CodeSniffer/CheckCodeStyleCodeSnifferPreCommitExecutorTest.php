<?php

namespace PhpGitHooks\Tests\Application\CodeSniffer;

use Mockery\Mock;
use PhpGitHooks\Application\CodeSniffer\CheckCodeStyleCodeSnifferPreCommitExecutor;
use PhpGitHooks\Infrastructure\CodeSniffer\CodeSnifferHandler;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;

/**
 * Class CheckCodeStyleCodeSnifferPreCommitExecutorTest.
 */
class CheckCodeStyleCodeSnifferPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckCodeStyleCodeSnifferPreCommitExecutor */
    private $checkCodeStyleCodeSnifferPreCommitExecutor;
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
        $this->codeSnifferHandler = $this->getMockBuilder('\PhpGitHooks\Infrastructure\CodeSniffer\CodeSnifferHandler')
            ->setMethods(['run'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->checkCodeStyleCodeSnifferPreCommitExecutor  = new CheckCodeStyleCodeSnifferPreCommitExecutor(
            $this->preCommitConfig,
            $this->codeSnifferHandler
        );
    }

    /**
     * @test
     */
    public function idDisabled()
    {
        $this->preCommitConfig->setExtraOptions(['enabled' => false, 'standard' => '']);

        $this->checkCodeStyleCodeSnifferPreCommitExecutor->run(
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
        $this->preCommitConfig->setExtraOptions(['enabled' => true, 'standard' => 'PSR2' ]);

        $this->checkCodeStyleCodeSnifferPreCommitExecutor->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
