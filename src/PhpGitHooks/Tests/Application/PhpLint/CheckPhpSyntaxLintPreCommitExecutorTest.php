<?php

namespace PhpGitHooks\Tests\Application\PhpLint;

use PhpGitHooks\Application\PhpLint\CheckPhpSyntaxLintPreCommitExecutor;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpLint\InMemoryPhpLintHandler;

/**
 * Class CheckPhpSyntaxLintPreCommitExecutorTest.
 */
class CheckPhpSyntaxLintPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckPhpSyntaxLintPreCommitExecutor */
    private $checkPhpSyntaxLintPreCommitExecutor;
    /** @var  InMemoryPhpLintHandler */
    private $phpLintHandler;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;

    protected function setUp()
    {
        $this->phpLintHandler = new InMemoryPhpLintHandler();
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->outputInterface = new InMemoryOutputInterface();

        $this->checkPhpSyntaxLintPreCommitExecutor = new CheckPhpSyntaxLintPreCommitExecutor(
            $this->preCommitConfig,
            $this->phpLintHandler
        );
    }

    /**
     * @test
     */
    public function toolIsDissabled()
    {
        $this->preCommitConfig->setEnabled(false);

        $this->checkPhpSyntaxLintPreCommitExecutor->run($this->outputInterface, array());
    }

    /**
     * @test
     */
    public function toolIsEnabled()
    {
        $this->preCommitConfig->setEnabled(true);

        $this->checkPhpSyntaxLintPreCommitExecutor->run($this->outputInterface, array());
    }
}
