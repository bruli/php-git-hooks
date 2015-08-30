<?php

namespace PhpGitHooks\Tests\Application\PhpCsFixer;

use PhpGitHooks\Application\PhpCsFixer\FixCodeStyleCsFixerPreCommitExecutor;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpCsFixer\InMemoryPhpCsFixerHandler;

/**
 * Class FixCodeStyleCsFixerPreCommitExecutorTest.
 */
class FixCodeStyleCsFixerPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  FixCodeStyleCsFixerPreCommitExecutor */
    private $fixCodeStyleCsFixerPreCommitExecutor;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;
    /** @var  InMemoryPhpCsFixerHandler */
    private $phpCsFixerHandler;

    protected function setUp()
    {
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->outputInterface = new InMemoryOutputInterface();
        $this->phpCsFixerHandler = new InMemoryPhpCsFixerHandler();
        $this->fixCodeStyleCsFixerPreCommitExecutor = new FixCodeStyleCsFixerPreCommitExecutor(
            $this->preCommitConfig,
            $this->phpCsFixerHandler
        );
    }

    /**
     * @test
     */
    public function idDisabled()
    {
        $this->preCommitConfig->setEnabled(false);
        $this->fixCodeStyleCsFixerPreCommitExecutor->run(
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

        $this->fixCodeStyleCsFixerPreCommitExecutor->run(
            $this->outputInterface,
            array(),
            'neddle'
        );
    }
}
