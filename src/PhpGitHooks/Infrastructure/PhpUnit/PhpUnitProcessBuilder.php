<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\ProcessBuilderInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitProcessBuilder.
 */
class PhpUnitProcessBuilder implements ProcessBuilderInterface
{
    /**
     * @param string $bin
     *
     * @return ProcessBuilder
     */
    public function getProcessBuilder($bin)
    {
        return new ProcessBuilder(array('php', $bin));
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
