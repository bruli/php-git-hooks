<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\ProcessBuilderInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class PhpUnitGenerateCloverFileProcessBuilder implements ProcessBuilderInterface
{
    const CLOVER_FILE = 'tmp-clover-file';

    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        return new ProcessBuilder(array('php', 'bin/phpunit', '--coverage-clover', self::CLOVER_FILE));
    }

    /**
     * @param Process         $process
     * @param OutputInterface $outputInterface
     *
     * @return int
     */
    public function executeProcess(Process $process, OutputInterface $outputInterface)
    {
        return $process->run(function ($type, $buffer) use ($outputInterface) {
            $type;
            $outputInterface->write($buffer);
        });
    }
}
