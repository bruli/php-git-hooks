<?php

namespace PhpGitHooks\Tests\Application\PhpUnit;

use Mockery\Mock;
use PhpGitHooks\Application\PhpUnit\PhpUnitHandler;
use PhpGitHooks\Application\PhpUnit\UnitTestPreCommitExecuter;
use PhpGitHooks\Command\InMemoryOutputHandler;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;

/**
 * Class UnitTestPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpUnit
 */
class UnitTestPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  UnitTestPreCommitExecuter */
    private $unitTestPreCommitExecuter;
    /** @var  InMemoryHookConfig */
    private $preCommitConfig;
    /** @var  PhpUnitHandler */
    private $phpUnitHandler;
    /** @var  InMemoryOutputInterface */
    private $outputInterface;
    /** @var  InMemoryOutputHandler */
    private $outputHandler;
    /** @var  Mock */
    private $phpunitProcessBuilder;
    /** @var  Mock */
    private $processBuilder;
    /** @var  Mock */
    private $process;

    protected function setUp()
    {
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->outputInterface = new InMemoryOutputInterface();
        $this->outputHandler = new InMemoryOutputHandler();
        $this->phpunitProcessBuilder = \Mockery::mock('PhpGitHooks\Infrastructure\PhpUnit\PhpUnitProcessBuilder');
        $this->processBuilder = \Mockery::mock('Symfony\Component\Process\ProcessBuilder');
        $this->process = \Mockery::mock('Symfony\Component\Process\Process');
        $this->process->shouldReceive('run')->andReturn(1);
        $this->process->shouldReceive('stop');

        $this->phpUnitHandler = new PhpUnitHandler($this->outputHandler, $this->phpunitProcessBuilder);
        $this->unitTestPreCommitExecuter = new UnitTestPreCommitExecuter(
            $this->preCommitConfig,
            $this->phpUnitHandler
        );
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->preCommitConfig->setEnabled(false);

        $this->unitTestPreCommitExecuter->run($this->outputInterface);
    }

    /**
     * @test
     */
    public function isEnabledAndSuccessful()
    {
        $this->process->shouldReceive('isSuccessful')->andReturn(true);
        $this->preCommitConfig->setEnabled(true);
        $this->enabledMocks();

        $this->phpunitProcessBuilder->shouldReceive('getProcessBuilder')->andReturn($this->processBuilder);
        $this->phpunitProcessBuilder->shouldReceive('executeProcess');

        $this->unitTestPreCommitExecuter->run($this->outputInterface);
    }

    /**
     * @test
     */
    public function isEnabledAndThrow()
    {
        $this->setExpectedException('PhpGitHooks\Application\PhpUnit\UnitTestsException');

        $this->preCommitConfig->setEnabled(true);
        $this->process->shouldReceive('isSuccessful')->andReturn(false);
        $this->enabledMocks();

        $this->phpunitProcessBuilder->shouldReceive('getProcessBuilder')->andReturn($this->processBuilder);
        $this->phpunitProcessBuilder->shouldReceive('executeProcess');

        $this->unitTestPreCommitExecuter->run($this->outputInterface);
    }

    private function enabledMocks()
    {
        $this->processBuilder->shouldReceive('setTimeout');
        $this->processBuilder->shouldReceive('getProcess')->andReturn($this->process);
    }
}
