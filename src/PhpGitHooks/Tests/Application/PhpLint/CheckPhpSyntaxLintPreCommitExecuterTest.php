<?php

namespace PhpGitHooks\Tests\Application\PhpLint;

use PhpGitHooks\Application\PhpLint\CheckPhpSyntaxLintPreCommitExecuter;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpLint\InMemoryPhpLintHandler;

/**
 * Class CheckPhpSyntaxLintPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpLint
 */
class CheckPhpSyntaxLintPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckPhpSyntaxLintPreCommitExecuter */
    private $checkPhpSyntaxLintPreCommitExecuter;
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

        $this->checkPhpSyntaxLintPreCommitExecuter = new CheckPhpSyntaxLintPreCommitExecuter(
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

        $this->checkPhpSyntaxLintPreCommitExecuter->run($this->outputInterface, array());
    }

    /**
     * @test
     */
    public function toolIsEnabled()
    {
        $this->preCommitConfig->setEnabled(true);

        $this->checkPhpSyntaxLintPreCommitExecuter->run($this->outputInterface, array());
    }
}
