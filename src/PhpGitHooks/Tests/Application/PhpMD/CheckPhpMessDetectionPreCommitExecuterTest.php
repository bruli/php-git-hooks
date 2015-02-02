<?php

namespace PhpGitHooks\Tests\Application\PhpMD;

use PhpGitHooks\Application\CodeSniffer\CheckCodeStyleCodeSnifferPreCommitExecuter;
use PhpGitHooks\Application\PhpMD\CheckPhpMessDetectionPreCommitExecuter;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpMD\InMemoryPhpMDHandler;

/**
 * Class CheckPhpMessDetectionPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpMD
 */
class CheckPhpMessDetectionPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckCodeStyleCodeSnifferPreCommitExecuter */
    private $checkPhpMessDetectionPreCommitExecuter;
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
        $this->preCommitConfig->setEnabled(false);
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
        $this->preCommitConfig->setEnabled(true);

        $this->checkPhpMessDetectionPreCommitExecuter->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
