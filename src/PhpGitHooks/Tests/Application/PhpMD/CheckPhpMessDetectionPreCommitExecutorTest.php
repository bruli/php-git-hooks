<?php

namespace PhpGitHooks\Tests\Application\PhpMD;

use PhpGitHooks\Application\CodeSniffer\CheckCodeStyleCodeSnifferPreCommitExecutor;
use PhpGitHooks\Application\PhpMD\CheckPhpMessDetectionPreCommitExecutor;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpMD\InMemoryPhpMDHandler;

/**
 * Class CheckPhpMessDetectionPreCommitExecutorTest.
 */
class CheckPhpMessDetectionPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckCodeStyleCodeSnifferPreCommitExecutor */
    private $checkPhpMessDetectionPreCommitExecutor;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var   InMemoryPhpMDHandler */
    private $phpMDHandler;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;

    protected function setUp()
    {
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->phpMDHandler = new InMemoryPhpMDHandler();
        $this->outputInterface = new InMemoryOutputInterface();
        $this->checkPhpMessDetectionPreCommitExecutor = new CheckPhpMessDetectionPreCommitExecutor(
            $this->preCommitConfig,
            $this->phpMDHandler
        );
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->preCommitConfig->setEnabled(false);
        $this->checkPhpMessDetectionPreCommitExecutor->run(
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
        $this->preCommitConfig->setEnabled(true);

        $this->checkPhpMessDetectionPreCommitExecutor->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
