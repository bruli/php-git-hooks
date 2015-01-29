<?php

namespace PhpGitHooks\Tests\Application\PhpUnit;

use Mockery\Mock;
use PhpGitHooks\Application\PhpUnit\PhpUnitHandler;
use PhpGitHooks\Application\PhpUnit\UnitTestPreCommitExecuter;

/**
 * Class UnitTestPreCommitExecuterTest
 * @package PhpGitHooks\Tests\Application\PhpUnit
 */
class UnitTestPreCommitExecuterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  UnitTestPreCommitExecuter */
    private $unitTestPreCommitExecuter;
    /** @var  Mock */
    private $preCommitConfig;
    /** @var  PhpUnitHandler */
    private $phpUnitHandler;
    /** @var  Mock */
    private $outputInterface;
    /** @var  Mock */
    private $outputHandler;
    /** @var  Mock */
    private $phpunitProcessBuilder;
    /** @var  Mock */
    private $processBuilder;
    /** @var  Mock */
    private $process;

    protected function setUp()
    {
        $this->preCommitConfig = \Mockery::mock('PhpGitHooks\Application\Config\PreCommitConfig');
        $this->outputInterface = \Mockery::mock('Symfony\Component\Console\Output\OutputInterface');
        $this->outputHandler = \Mockery::mock('PhpGitHooks\Command\OutputHandler');
        $this->phpunitProcessBuilder = \Mockery::mock('PhpGitHooks\Infrastructure\PhpUnit\PhpUnitProcessBuilder');
        $this->processBuilder = \Mockery::mock('PhpGitHooks\Infrastructure\PhpUnit\PhpUnitProcessBuilder');
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
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(false);

        $this->unitTestPreCommitExecuter->run($this->outputInterface);
    }

    /**
     * @test
     */
    public function isEnabledAndSuccessful()
    {
        $this->process->shouldReceive('isSuccessful')->andReturn(true);
        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(true);
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

        $this->preCommitConfig->shouldReceive('isEnabled')->andReturn(true);
        $this->process->shouldReceive('isSuccessful')->andReturn(false);
        $this->enabledMocks();

        $this->phpunitProcessBuilder->shouldReceive('getProcessBuilder')->andReturn($this->processBuilder);
        $this->phpunitProcessBuilder->shouldReceive('executeProcess');

        $this->unitTestPreCommitExecuter->run($this->outputInterface);
    }

    private function enabledMocks()
    {
        $this->outputHandler->shouldReceive('setTitle');
        $this->outputHandler->shouldReceive('getTitle');
        $this->outputHandler->shouldReceive('getSuccessfulStepMessage');
        $this->outputInterface->shouldReceive('write');
        $this->outputInterface->shouldReceive('writeln');
        $this->processBuilder->shouldReceive('setTimeout');
        $this->processBuilder->shouldReceive('getProcess')->andReturn($this->process);
    }
}
