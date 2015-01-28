<?php

namespace PhpGitHooks\Tests\Application\PhpLint;

use Mockery\Mock;
use PhpGitHooks\Application\PhpLint\CheckPhpSyntaxLintPreCommitExecuter;

/**
 * Class CheckPhpSyntaxLintPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpLint
 */
class CheckPhpSyntaxLintPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CheckPhpSyntaxLintPreCommitExecuter */
    private $checkPhpSyntaxLintPreCommitExecuter;
    /** @var  Mock */
    private $phpLintHandler;
    /** @var  Mock */
    private $preCommitConfig;
    /** @var  Mock */
    private $outputInterface;

    protected function setUp()
    {
        $this->phpLintHandler = \Mockery::mock('PhpGitHooks\Infrastructure\PhpLint\PhpLintHandler');
        $this->preCommitConfig = \Mockery::mock('PhpGitHooks\Application\Config\PreCommitConfig');
        $this->outputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');

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
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(false);

        $this->checkPhpSyntaxLintPreCommitExecuter->run($this->outputInterface, array());
    }

    /**
     * @test
     */
    public function toolIsEnabled()
    {
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(true);
        $this->phpLintHandler->shouldReceive('setOutput');
        $this->phpLintHandler->shouldReceive('setFiles');
        $this->phpLintHandler->shouldReceive('run');

        $this->checkPhpSyntaxLintPreCommitExecuter->run($this->outputInterface, array());
    }
}
