<?php

namespace PhpGitHooks\Tests\Application\PhpUnit;

use Mockery\Mock;
use PhpGitHooks\Application\PhpUnit\PhpUnitHandler;
use PhpGitHooks\Application\PhpUnit\UnitTestPreCommitExecutor;
use PhpGitHooks\Application\PhpUnit\UnitTestsException;
use PhpGitHooks\Command\InMemoryOutputHandler;
use PhpGitHooks\Infrastructure\Component\InMemoryOutputInterface;
use PhpGitHooks\Infrastructure\Config\InMemoryHookConfig;
use PhpGitHooks\Infrastructure\PhpUnit\PhpUnitProcessBuilder;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;
use PhpGitHooks\Application\PhpUnit\PhpUnitRandomizerHandler;

/**
 * Class UnitTestPreCommitExecutorTest.
 */
class UnitTestPreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    /** @var  UnitTestPreCommitExecutor */
    private $unitTestPreCommitExecutor;
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
    /** @var  Mock */
    private $phpunitRandomizerBuilder;

    protected function setUp()
    {
        $this->preCommitConfig = new InMemoryHookConfig();
        $this->outputInterface = new InMemoryOutputInterface();
        $this->outputHandler = new InMemoryOutputHandler();
        $this->phpunitProcessBuilder = \Mockery::mock(PhpUnitProcessBuilder::class);
        $this->phpunitRandomizerBuilder = \Mockery::mock(PhpUnitRandomizerHandler::class);
        $this->processBuilder = \Mockery::mock(ProcessBuilder::class);
        $this->process = \Mockery::mock(Process::class);
        $this->process->shouldReceive('run')->andReturn(1);
        $this->process->shouldReceive('stop');

        $this->phpUnitHandler = new PhpUnitHandler($this->outputHandler, $this->phpunitProcessBuilder);
        $this->unitTestPreCommitExecutor = new UnitTestPreCommitExecutor(
            $this->preCommitConfig,
            $this->phpUnitHandler,
            $this->phpunitRandomizerBuilder
        );
    }

    /**
     * @test
     */
    public function isDisabled()
    {
        $this->preCommitConfig->setExtraOptions(['enabled' => false]);

        $this->unitTestPreCommitExecutor->run($this->outputInterface);
    }

    /**
     * @test
     */
    public function isEnabledAndSuccessful()
    {
        $this->process->shouldReceive('isSuccessful')->andReturn(true);
        $this->preCommitConfig->setExtraOptions(['enabled' => true, 'random-mode' => false, 'suite' => false]);
        $this->enabledMocks();

        $this->phpunitProcessBuilder->shouldReceive('getProcessBuilder')->andReturn($this->processBuilder);
        $this->phpunitProcessBuilder->shouldReceive('executeProcess');

        $this->unitTestPreCommitExecutor->run($this->outputInterface);
    }

    /**
     * @test
     */
    public function isEnabledAndSuccessfulWithSuite()
    {
        $this->process->shouldReceive('isSuccessful')->andReturn(true);
        $this->preCommitConfig->setExtraOptions([
            'enabled' => true,
            'random-mode' => false,
            'suite' => 'PhpGitHooks Unit Tests',
        ]);
        $this->enabledMocks();

        $this->phpunitProcessBuilder->shouldReceive('setSuite');
        $this->phpunitProcessBuilder->shouldReceive('getProcessBuilder')->andReturn($this->processBuilder);
        $this->phpunitProcessBuilder->shouldReceive('executeProcess');

        $this->unitTestPreCommitExecutor->run($this->outputInterface);
    }

    /**
     * @test
     */
    public function isEnabledAndThrow()
    {
        $this->setExpectedException(UnitTestsException::class);
        $this->phpunitRandomizerBuilder->shouldReceive('setOutput');
        $this->phpunitRandomizerBuilder->shouldReceive('run');

        $this->preCommitConfig->setExtraOptions(['enabled' => true, 'random-mode' => false, 'suite' => false]);
        $this->process->shouldReceive('isSuccessful')->andReturn(false);
        $this->enabledMocks();

        $this->phpunitProcessBuilder->shouldReceive('getProcessBuilder')->andReturn($this->processBuilder);
        $this->phpunitProcessBuilder->shouldReceive('executeProcess');

        $this->unitTestPreCommitExecutor->run($this->outputInterface);
    }

    private function enabledMocks()
    {
        $this->processBuilder->shouldReceive('setTimeout');
        $this->processBuilder->shouldReceive('getProcess')->andReturn($this->process);
    }
}
