<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Interface ProcessBuilderInterface
 * @package PhpGitHooks\Infrastructure\Common
 */
interface ProcessBuilderInterface
{
    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder();

    /**
     * @param  Process         $process
     * @param  OutputInterface $outputInterface
     * @return int
     */
    public function executeProcess(Process $process, OutputInterface $outputInterface);
}
