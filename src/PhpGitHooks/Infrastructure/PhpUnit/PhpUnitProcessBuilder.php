<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitProcessBuilder
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class PhpUnitProcessBuilder
{
    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        return new ProcessBuilder(array('php', 'bin/phpunit'));
    }

    /**
     * @param  Process         $process
     * @param  OutputInterface $outputInterface
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
