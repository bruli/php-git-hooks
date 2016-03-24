<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Interface ProcessBuilderInterface.
 */
interface ProcessBuilderInterface
{
    /**
     * @param string $bin
     *
     * @return ProcessBuilder
     */
    public function getProcessBuilder($bin);

    /**
     * @param Process         $process
     * @param OutputInterface $outputInterface
     *
     * @return int
     */
    public function executeProcess(Process $process, OutputInterface $outputInterface);
}
