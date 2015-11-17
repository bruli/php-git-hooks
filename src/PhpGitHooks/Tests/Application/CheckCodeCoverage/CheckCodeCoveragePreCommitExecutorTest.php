<?php

namespace PhpGitHooks\Application\CodeCoverage;

class CheckCodeCoveragePreCommitExecutorTest extends \PHPUnit_Framework_TestCase
{
    public function testRun()
    {
        $phpunitHandlerMock = \Mockery::mock('PhpGitHooks\Application\PhpUnit\PhpUnitHandler');
        $preCommitConfig = \Mockery::mock('PhpGitHooks\Application\Config\PreCommitConfig');
        $outputMock = \Mockery::mock('\Symfony\Component\Console\Output\OutputInterface');
        $cloverFileProcessorMock = \Mockery::mock('PhpGitHooks\Application\CodeCoverage\CloverFileProcessor');

        $executor = new CheckCodeCoveragePreCommitExecutor($phpunitHandlerMock, $preCommitConfig, $cloverFileProcessorMock);

        $preCommitConfig->shouldReceive('extraOptions')->andReturn(['enabled' => true, 'percentage' => 70]);
        $phpunitHandlerMock->shouldReceive('setOutput')->with($outputMock)->once();
        $phpunitHandlerMock->shouldReceive('run')->once();
        $cloverFileProcessorMock->shouldReceive('calculateOverallCodeCoverage')->once()->andReturn(90);

        $executor->run($outputMock);
    }
}
